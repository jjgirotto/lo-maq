<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Categoria;
//use App\Models\Equipamento;
//use App\Models\User;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();

        $layout = (auth()->user()?->access === 'ADM')
            ? 'layouts.admin'
            : 'layouts.default';

        return view('categorias.index', compact('categorias'))
            ->with('layout', $layout);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layout = (auth()->user()?->access === 'ADM')
            ? 'layouts.admin'
            : 'layouts.default';

        return view('categorias.create')
            ->with('layout', $layout);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'titulo' => 'required|max:255'
            ]);

            Categoria::create($request->all());

            return redirect()->route('categorias.index')
                ->with('sucesso', 'Categoria cadastrada com sucesso!');

        } catch (\Exception $e) {

            Log::error(
                'Erro ao cadastrar categoria! ' . $e->getMessage(),
                [
                    'trace' => $e->getTraceAsString(),
                    'request' => $request->all()
                ]
            );

            return redirect()->route('categorias.index')
                ->with('erro', 'Erro ao cadastrar categoria!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $layout = (auth()->user()?->access === 'ADM')
            ? 'layouts.admin'
            : 'layouts.default';

        return view('categorias.show', compact('categoria'))
            ->with('layout', $layout);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $layout = (auth()->user()?->access === 'ADM')
            ? 'layouts.admin'
            : 'layouts.default';

        return view('categorias.edit', compact('categoria'))
            ->with('layout', $layout);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $request->validate([
                'titulo' => 'required|max:255'
            ]);

            $categoria = Categoria::findOrFail($id);

            $categoria->update($request->all());

            return redirect()->route('categorias.index')
                ->with('sucesso', 'Categoria alterada com sucesso!');

        } catch (\Exception $e) {

            Log::error(
                'Erro ao alterar categoria! ' . $e->getMessage(),
                [
                    'trace' => $e->getTraceAsString(),
                    'request' => $request->all()
                ]
            );

            return redirect()->route('categorias.index')
                ->with('erro', 'Erro ao alterar categoria!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $categoria = Categoria::findOrFail($id);

            $categoria->delete();

            return redirect()->route('categorias.index')
                ->with('sucesso', 'Categoria excluída com sucesso!');

        } catch (\Exception $e) {

            Log::error(
                'Erro ao excluir categoria! ' . $e->getMessage(),
                [
                    'trace' => $e->getTraceAsString(),
                    'id' => $id
                ]
            );

            return redirect()->route('categorias.index')
                ->with('erro', 'Erro ao excluir categoria!');
        }
    }
}
