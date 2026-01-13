<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Proof;

class ProofController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'referencia'=>['required', 'unique:proofs,referencia'],
            'comment'=>'nullable'
        ]);

        Proof::create([
            'nome'=>$request->nome,
            'referencia'=>$request->referencia,
            'comment'=>$request->comment,
            'data'=>Carbon::now()->format('Y-m-d')
        ]);

        return redirect()->back();
    }

    public function searchByDate(Request $request)
    {
        $proofs = Proof::whereYear('data', $request->ano)->
        whereMonth('data', $request->mes)->
        get();

        return view('proof.index', compact('proofs'));
    }

}
