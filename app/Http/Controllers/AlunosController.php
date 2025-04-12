<?php

namespace App\Http\Controllers;

use App\Models\alunos;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = alunos::All();
        $contador = $regBook->count();
 
        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'alunos encontrados com sucesso',
                'data' => $regBook,
                'total' => $contador
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum aluno encontrada',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->ALL(), [
            'nome' => 'required',
            'curso' => 'required',
            'idade' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }
 
        $regBook = alunos::create($request->ALL());
 
        if ($regBook) {
            return response()->json([
                'success' => true,
                'message' => 'alunos cadastrada com sucesso!',
                'data' => $regBook
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar alunos',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $regBook = alunos::find($id);
 
        if ($regBook) {
            return response()->json([
                'success' => true,
                'message' => 'alunos encontrada com sucesso',
                'data' => $regBook
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum aluno encontrado',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $regBook = alunos::find($id);
        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'alunos não encontrada',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'curso' => 'required',
            'idade' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }
 
        $regBook->nome = $request->input('nome');
        $regBook->curso = $request->input('curso');
        $regBook->idade = $request->input('idade');
 
        if ($regBook->save()) {
            return response()->json([
                'success' => true,
                'message' => 'alunos atualizada com sucesso',
                'data' => $regBook
            ], 200);
        } else {
            return response(   )->json([
                'success' => false,
                'message' => 'Erro ao atualizar alunos',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regBook = alunos::find($id);
 
        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'alunos não encontrada',
            ], 404);
        }
 
        if ($regBook->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'alunos excluida com sucesso',
            ], 200);
        } 
        
        else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir alunos',
            ], 500);
        }
    }
}
