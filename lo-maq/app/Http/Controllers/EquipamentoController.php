<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Equipamento;
use App\Models\Categoria;
use App\Models\User;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $locador = User::all();

        if (auth()->user()->access !== 'ADM') {
            $locador = User::where('id', auth()->id())->get();
        }

        $layout = (auth()->user()->access === 'ADM') ? 'layouts.admin' : 'layouts.default';

        return view("equipamentos.create", compact('categorias', 'locador'))->with('layout', $layout);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('equipamentos', 'public');
                $data['image_path'] = $path;
            }

            Equipamento::create($data);
            return redirect()->route("equipamentos.index")
                ->with("sucesso", "Registro inserido!");
        } catch (\Exception $e) {
            Log::error("Erro ao salvar o registro do equipamento! " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route("equipamentos.index")
                ->with("erro", "Erro ao inserir!" . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
