<?php

namespace App\Http\Controllers;

use App\Models\professors;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProfessorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = professors::All();
        $contador = $regBook->count();

        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'professores encontrados com sucesso',
                'data' => $regBook,
                'total' => $contador
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum professor encontrado',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'disciplina' => 'required',
            'idade' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $regBook = professors::create($request->all());

        if ($regBook) {
            return response()->json([
                'success' => true,
                'message' => 'professor cadastrado com sucesso!',
                'data' => $regBook
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar professor',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $regBook = professors::find($id);

        if ($regBook) {
            return response()->json([
                'success' => true,
                'message' => 'professor encontrado com sucesso',
                'data' => $regBook
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum professor encontrado',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $regBook = professors::find($id);

        if ($regBook) {
            $regBook->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'professor atualizado com sucesso',
                'data' => $regBook
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar professor',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regBook = professors::find($id);

        if ($regBook) {
            $regBook->delete();
            return response()->json([
                'success' => true,
                'message' => 'professor deletado com sucesso',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao deletar professor',
            ], 500);
        }
    }
}
