<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Entrada;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios = Comentario::all();

        return view('comentarios.index', compact('comentarios'));
    }

    public function create()
    {
        $entradas = Entrada::all();

        return view('comentarios.create', compact('entradas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $entrada = request('entrada_id');

        Comentario::create([
            'email' => request('email'),
            'texto' => request('texto'),
            'fecha' => now(),
            'visible' => $request->has('visible'),
            'entrada_id' => $entrada,
        ]);

        return redirect(route('entradas.show', compact('entrada')));
    }

    public function show(Comentario $comentario)
    {
        return view('comentarios.show', compact('comentario'));
    }

    public function edit(Comentario $comentario)
    {
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, Comentario $comentario)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $comentario->update([
            'email' => request('email'),
            'texto' => request('texto'),
            'fecha' => request('fecha'),
            'visible' => $request->has('visible'),
        ]);

        return redirect(route('comentarios.index'));
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();

        return back();
    }
}
