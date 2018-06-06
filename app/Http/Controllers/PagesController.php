<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateMessageRequest;

class PagesController extends Controller
{


    public function home()
    {

    	return view('home');

    }


    public function contactos()
    {

    	return view('contactos');

    }


    public function mensajes(CreateMessageRequest $request)
    {

        return $request->all();

    }


    public function saludo( $nombre = 'Invitado')
    {
		
		$html = '<h2>Código html</h2>';

		$naruto_amigos = ['Naruto', 'Shakura', 'Sasuke'];
		$naruto_enemigos = [];

		return view('saludo', compact('nombre', 'html', 'naruto_amigos', 'naruto_enemigos'));

    }


}
