<?php

namespace App\Http\Controllers;

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
        
        if ($user->tipo === 'paciente') {
            return redirect('minhas-consultas');
        } elseif ($user->tipo === 'medico') {
            return redirect('minha-agenda');
        } elseif ($user->tipo === 'secretaria') {
            return redirect('gerenciar/agenda');
        }
        return view('home');
    }
}
