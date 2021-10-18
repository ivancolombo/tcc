<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if (($user->tipo === 'paciente' || $user->tipo === 'medico') && $user->termo === false) {
            return view('termo.index');
        }
        
        if ($user->tipo === 'paciente') {
            return redirect('minhas-consultas');
        } elseif ($user->tipo === 'medico') {
            return redirect('minha-agenda');
        } elseif ($user->tipo === 'secretaria') {
            return redirect('gerenciar/agenda');
        }
        return view('home');
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

        return redirect()->back();
    }
}
