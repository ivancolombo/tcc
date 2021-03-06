<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if (($user->tipo === 'paciente' || $user->tipo === 'medico') && $user->termo === true) {            
            return redirect('/');
        }

        return view('termo.index');
    }

    public function aceitarTermo(Request $request)
    {
        $validatedData = $request->validate([
            'aceite_termos' => ['required'],
        ]);

        User::where('id', Auth::id())
            ->update([
                'termo' => true
            ]);

        return redirect('/');
    }
}
