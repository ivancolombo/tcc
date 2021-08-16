<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        return view('medico.index');
    }

    public function create()
    {
        return view('medico.create');
    }
}
