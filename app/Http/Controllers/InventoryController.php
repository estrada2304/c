<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryExport;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $inventory = Inventory::orderBy('created_at', 'desc')->paginate(10);
        return view('inventory.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ['BUFR', 'FAULTY', 'MIA', 'SCRAP', 'EXS'];
        $statuses = ['CO', 'OP', 'CL'];
        return view('inventory.create', compact('categories', 'statuses'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        Inventory::create($request->validated());
        
        return redirect()->route('inventory.index')
            ->with('success', 'Ítem agregado al inventario exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $categories = ['BUFR', 'FAULTY', 'MIA', 'SCRAP', 'EXS'];
        $statuses = ['CO', 'OP', 'CL'];
        return view('inventory.edit', compact('inventory', 'categories', 'statuses'));
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        
        return redirect()->route('inventory.index')
            ->with('success', 'Ítem actualizado exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        
        return redirect()->route('inventory.index')
            ->with('success', 'Ítem eliminado exitosamente');
    }

    /**
     * Export the inventory to an Excel file.
     */
    public function export()
    {
        return Excel::download(new InventoryExport, 'inventario.xlsx');
    }
}
