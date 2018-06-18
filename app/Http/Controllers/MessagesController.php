<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class MessagesController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth', ['except' => ['create', 'store']]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        //$messages = DB::table('messages')->get();

        //return Message::all(); // Automáticamente se convierte en json

        $messages = Message::all();

        return view('messages.index', compact('messages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('messages.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Guardar mensaje 

        /* DB::table('messages')->insert([
            "nombre" => $request->input('nombre'),
            "email" => $request->input('email'),
            "mensaje" => $request->input('mensaje'),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]); */


        // Forma 1 de Guardar eloquent
        /*$message = new Message();// Transparentemente hace un create row
        $message->nombre = $request->input('nombre');
        $message->email = $request->input('email');
        $message->mensaje = $request->input('mensaje');
        // Con Eloquent no necesitamos pasarle las fechas
        // se añaden automáticamente
        $message->save();*/


        // Forma 2 guardar eloquent
        // Necesitamos rellenar el Fillable del model

        Message::create($request->all());


        // Redireccionar

        return redirect()->route('mensajes.create')
            ->with('info', 'Hemos recibido tu mensaje');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $message = DB::table('messages')->where('id', $id)->first();
        //$message = Message::find($id); // si no lo encuentra, devuelve null
        $message = Message::findOrFail($id); // si no lo encuentra genera un 404 y una excepcion
        // La página 404 se puede definir en views/errors/404.blade.php

        return view('messages.show', compact('message'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //$message = DB::table('messages')->where('id', $id)->first();
        $message = Message::findOrFail($id);

        return view('messages.edit', compact('message'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //Actualizar mensaje
        /*DB::table('messages')->where('id', $id)->update([
            "nombre" => $request->input('nombre'),
            "email" => $request->input('email'),
            "mensaje" => $request->input('mensaje'),            
            "updated_at" => Carbon::now(),
        ]);*/

        $message = Message::findOrFail($id);
        $message->update($request->all());

        // Redireccionar
        return redirect()->route('mensajes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // Eliminar mensaje
        //DB::table('messages')->where('id', $id)->delete();
        $message = Message::findOrFail($id);
        $message->delete();

        // Redireccionar
        return redirect()->route('mensajes.index');

    }
}
