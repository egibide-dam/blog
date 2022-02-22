<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::all();

        return view('entradas.index', compact('entradas'));
    }

    public function create()
    {
        return view('entradas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
        ]);

        Entrada::create([
            'titulo' => request('titulo'),
            'texto' => request('texto'),
            'fecha' => request('fecha'),
            'visible' => $request->has('visible'),
        ]);

        return redirect(route('entradas.index'));
    }

    public function show(Entrada $entrada)
    {
        return view('entradas.show', compact('entrada'));
    }

    public function edit(Entrada $entrada)
    {
        return view('entradas.edit', compact('entrada'));
    }

    public function update(Request $request, Entrada $entrada)
    {
        $this->validate($request, [
            'titulo' => 'required',
        ]);

        $entrada->update([
            'titulo' => request('titulo'),
            'texto' => request('texto'),
            'fecha' => request('fecha'),
            'visible' => $request->has('visible'),
        ]);

        return redirect(route('entradas.index'));
    }

    public function destroy(Entrada $entrada)
    {
        $entrada->delete();

        return back();
    }

    public function comentarios(Entrada $entrada)
    {
        return view('entradas.comentarios', compact('entrada'));
    }
}
