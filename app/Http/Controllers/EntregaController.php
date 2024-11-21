<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Venta;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Alert;
class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('superAdmin')) {
            $entregas = Entrega::with(['venta', 'aprobadoPor', 'user'])->get();

        }else{
            $entregas = Entrega::with(['venta', 'aprobadoPor', 'user'])->where('user_id', Auth::user()->id)->get();

        }
        return view('entregas.index', compact('entregas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventas = Venta::all();
        $users = User::all();
        return view('entregas.create', compact('ventas', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'costo' => 'nullable|numeric',
            'fecha_entrega' => 'nullable|date',
            'status' => 'required|string|max:255',
            'aprobado_por' => 'nullable|exists:users,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Entrega::create($request->all());

        return redirect()->route('entregas.index')->with('success', 'Entrega creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrega $entrega)
    {
        $entrega->load(['venta', 'aprobadoPor', 'user']);
        return view('entregas.show', compact('entrega'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrega $entrega)
    {
        $ventas = Venta::all();
        $users = User::all();
        return view('entregas.edit', compact('entrega', 'ventas', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrega $entrega)
    {
        

        $entrega->update($request->all());

        $entrega->user->notify(new \App\Notifications\ActualizarEntrega($entrega, $request->status));
        Alert::success('¡Exito!', 'Entrega actualizada correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('entregas.index')->with('success', 'Entrega actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        $entrega->delete();

        return redirect()->route('entregas.index')->with('success', 'Entrega eliminada correctamente.');
    }
}
