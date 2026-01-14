<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Proof;
use PhpOption\None;

class ProofController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
            'nome'=>'required',
            'referencia'=>['required', 'unique:proofs,referencia'],
            'comment'=>'nullable'
        ]);

            Proof::create([
                'nome'=>$request->nome,
                'referencia'=>$request->referencia,
                'comment'=>$request->comment
            ]);

            return redirect()->back()->with('success', 'Prova foi guardada com sucesso!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro, a prova não foi guardada');
        }

    }

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

}
