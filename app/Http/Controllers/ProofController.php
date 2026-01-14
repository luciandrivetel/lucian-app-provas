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

    public function searchByRef(Request $request)
    {
        $proofs = Proof::where('referencia', 'LIKE', '%' . $request->referencia . '%')->get();

        return view('home', compact('proofs'));
    }

}
