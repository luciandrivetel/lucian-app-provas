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

    // public function searchByRef(Request $request)
    // {
    //     $proofs = Proof::where('referencia', 'LIKE', '%' . $request->referencia . '%');

    //     return view('home', compact('proofs'));
    // }

    public function searchByRef()
    {
        $user = ['nome'=>'Nome Prod',
                    'referencia'=>'1234567890',
                    'data'=>'2026'];
        return view('home', compact('user'));
    }

}
