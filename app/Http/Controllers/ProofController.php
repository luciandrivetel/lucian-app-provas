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

    public function searchByRef(Request $request)
    {
        //OLD: $proofs = Proof::where('referencia', 'LIKE', '%' . $request->referencia . '%')->get();

        //SOLUÇÂO https://stackoverflow.com/questions/48089966/how-to-get-search-query-from-multiple-columns-in-database
        $keyword = $request->nome_ref;
        $proofs = Proof::where(function($query) use($keyword)
        {
            $query->where('referencia', 'LIKE', '%' . $keyword . '%')
            ->orWhere('nome', 'LIKE', '%' . $keyword . '%');
        })->get();

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

    
        public function update(UpdateProofRequest $request, $id)
    {

        if (!$proof = Proof::find($id)) {
            return back()->with('error', 'Prova não encontrada');
        }

        $proof->update($request->validated());

        return redirect()->route('proof.index')->with('success', 'Prova atualizada com sucesso');

    }

    public function delete($id)
    {
        if(!$proof = Proof::find($id)){
            return back()->with('error', 'Prova não encontrada');
        }
        //dd($proof->id);
        $proof_name = $proof->nome;

        $proof->delete();

        return back()->with('success', "Prova '{$proof_name}' apagada com sucesso!");
    }

}
