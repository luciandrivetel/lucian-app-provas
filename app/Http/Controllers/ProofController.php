<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProofRequest;
use App\Http\Requests\UpdateProofRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Proof;
use Exception;
use PhpOption\None;

class ProofController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(StoreProofRequest $request)
    {

        Proof::create([
            'nome'=>$request->nome,
            'referencia'=>$request->referencia,
            'comment'=>$request->comment
        ]);

        return redirect()->route('proof.index')->with('success', 'Prova foi guardada com sucesso!');

    }

// Fara Request separat:
    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //         'nome'=>'required',
    //         'referencia'=>['required', 'unique:proofs,referencia'],
    //         'comment'=>'nullable'
    //     ]);

    //         Proof::create([
    //             'nome'=>$request->nome,
    //             'referencia'=>$request->referencia,
    //             'comment'=>$request->comment
    //         ]);

    //         return redirect()->back()->with('success', 'Prova foi guardada com sucesso!');
    //     }
    //     catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Erro, a prova não foi guardada');
    //     }

    // }

    public function searchByRef(Request $request)
    {
        $proofs = Proof::where('referencia', 'LIKE', '%' . $request->referencia . '%')->get();

        return view('home', compact('proofs'));
    }

    public function searchByDate(Request $request)
    {
        // dd($request->all());

        $proofs_date = Proof::whereYear('created_at', $request->ano)->whereMonth('created_at', $request->mes)->get();

        return view('home', compact('proofs_date'));

    }

    public function edit($id)
    {
        if (!$proof = Proof::find($id)){
            return redirect()->route('proof.index')->with('error', 'Nenhuma prova encontrada');
        }

        return view('edit', compact('proof'));
    }

    //Fara request separat, merge

    // public function update(Request $request, $id)
    // {   try {
    //         $request->validate([
    //             'nome'=>'required',
    //             'referencia'=>['required', 'unique:proofs,referencia'],
    //             'comment'=>'nullable'
    //         ]);

    //         if (!$proof = Proof::find($id)) {
    //             return back()->with('error', 'Prova não encontrada');
    //         }

    //         $proof->update($request->only([
    //             'nome',
    //             'referencia',
    //             'comment'
    //         ]));

    //         return redirect()->route('proof.index')->with('success', 'Prova atualizada com sucesso');
    //         }
    //     catch(\Exception $e) {
    //         return redirect()->back()->with('error', "O nome do material e a rêferencia são obrigatorias");
    //     }

    // }

        public function update(UpdateProofRequest $request, $id)
    {

        if (!$proof = Proof::find($id)) {
            return back()->with('error', 'Prova não encontrada');
        }

        $proof->update($request->validated());

        return redirect()->route('proof.index')->with('success', 'Prova atualizada com sucesso');

    }

}
