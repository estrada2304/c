public function handle(Request $request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();
    
    foreach ($roles as $role) {
        if ($user->role->name === $role) {
            return $next($request);
        }
    }

    abort(403, 'No tienes permiso para acceder a esta página');
}