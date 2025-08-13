<?php $__env->startSection('content'); ?>
<div class="login-container" style="background-image: url('/images/antena-background.jpg');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-box">
                    <!-- Logo y Nombre de la Empresa -->
                    <div class="text-center mb-4">
                        <div class="company-name">ROTOPOOL</div>
                        <h2 class="text-green">Iniciar Sesión</h2>
                    </div>

                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><?php echo e(__('Correo Electrónico')); ?></label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label"><?php echo e(__('Contraseña')); ?></label>
                            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   name="password" required autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Recordar sesión -->
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="remember">
                                    <?php echo e(__('Recordar sesión')); ?>

                                </label>
                            </div>
                        </div>

                        <!-- Botón de Login -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-login w-100">
                                <?php echo e(__('Ingresar')); ?>

                            </button>
                        </div>

                        <!-- Olvidé mi contraseña -->
                        <?php if(Route::has('password.request')): ?>
                            <div class="text-center mt-3">
                                <a class="text-green" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('¿Olvidaste tu contraseña?')); ?>

                                </a>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos personalizados */
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .company-name {
        color: #2ecc71; /* Verde Kaitoke */
        font-weight: bold;
        font-size: 2.5rem;
        margin-bottom: 10px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .text-green {
        color: #2ecc71;
    }

    .btn-login {
        background-color: #2ecc71;
        color: white;
        border: none;
        padding: 10px;
        font-weight: 600;
    }

    .btn-login:hover {
        background-color: #27ae60;
    }

    .form-control:focus {
        border-color: #2ecc71;
        box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.25);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-box {
            padding: 20px;
        }
        .company-name {
            font-size: 2rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Professional Machine\rotopool-management\resources\views/auth/login.blade.php ENDPATH**/ ?>