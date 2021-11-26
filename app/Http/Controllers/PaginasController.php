<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginasController extends Controller
{
    public function info()
    {
        return view('info');
    }
    public function contacto()
    {
        return view('contacto');
    }

    public function inicio()
    {
        return view('inicio');
    }

    public function feedback()
    {
        return view('feedback');
    }

    public function recibeContacto(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'comentario' => ['required','min:10'],
        ]);

        $contacto = new Contacto();
        $contacto->correo = $request->correo;
        $contacto->comentario = $request->comentario;
        $contacto->telefono = $request->telefono;
        $contacto->save();

        return redirect()->route('contacto');
    }

}
