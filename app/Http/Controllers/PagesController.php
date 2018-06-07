<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateMessageRequest;

class PagesController extends Controller
{


    public function __construct()
    {

        $this->middleware('example2', ['except' => 'home']);
        // ['only' => 'home']
    }


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

        //return $request->all();

        /*$data = $request->all();

        return response()->json([
            'data' => $data
        ], 202)
        ->header('TOKEN', 'secret');*/

        /*return redirect()
            ->route('contactos')
            ->with('info', 'Tu mensaje se ha enviado correctamente');*/

        return back()->with('info', 'Tu mensaje se ha enviado correctamente');

    }


    public function saludo( $nombre = 'Invitado')
    {
		
		$html = '<h2>Código html</h2>';

		$naruto_amigos = ['Naruto', 'Shakura', 'Sasuke'];
		$naruto_enemigos = [];

		return view('saludo', compact('nombre', 'html', 'naruto_amigos', 'naruto_enemigos'));

    }


}
