<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\MessageWasReceibed;
use Illuminate\Routing\Redirector;
use Illuminate\Events\Dispatcher as Event;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\MessagesInterface;

class MessagesController extends Controller
{


    protected $messages;
    protected $view;


    public function __construct(MessagesInterface $messages, ViewFactory $view, Redirector $redirect)
    {

        $this->messages = $messages;
        $this->view = $view;
        $this->redirect = $redirect;
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

        //$messages = Message::all();

        // eager loading
        // $messages = Message::with(['user', 'note', 'tags'])->get();

        // $key = 'message.page.' . request('page', 1);

        // if( Cache::has($key) ){

        //     $messages = Cache::get($key);

        // } else {

        //     // pagination with eager loading
        //     $messages = Message::with(['user', 'note', 'tags'])
        //         // ->latest()
        //         ->orderBy('created_at', request('sorted', 'DESC'))
        //         ->paginate(10);

        //     Cache::put($key, $messages, 5);

        // }

        // $key = 'message.page.' . request('page', 1);

        // //$messages = Cache::remember($key, 5, function() {
        // // $messages = Cache::rememberForever($key, function() {
        // $messages = Cache::tags('messages')->rememberForever($key, function() {
        //     return Message::with(['user', 'note', 'tags'])
        //             ->orderBy('created_at', request('sorted', 'DESC'))
        //             ->paginate(10);
        // });

        $messages = $this->messages->getPaginated();

        // return view('messages.index', compact('messages'));
        return $this->view->make('messages.index', compact('messages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return $this->view->make('messages.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        
        // 1 Guardar mensaje autenticados y no
        // $message = Message::create($request->all());

        // if( auth()->check() ) {
        //     auth()->user()->messages()->save($message);
        // }

        // 2 Si los usuarios están autenticados
        // auth()->user()->messages()->create($request->all());

        // 3 guardar con el id
        // $message = Message::create($request->all());
        // $message->user_id = auth()->id();

        // Con cache
        // $message = Message::create($request->all());

        // if( auth()->check() ) {
        //     auth()->user()->messages()->save($message);
        // }

        // // Cache::flush();
        // Cache::tags('messages')->flush();

        // Con repositorio
        $message = $this->messages->store($request);

        $event->fire(new MessageWasReceibed($message));    


        // Redireccionar

        return $this->redirect->route('mensajes.create')
            ->with('info', 'Hemos recibido tu mensaje')
            ;

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
        // $message = Message::findOrFail($id); // si no lo encuentra genera un 404 y una excepcion
        // La página 404 se puede definir en views/errors/404.blade.php

        // Cacheando la consulta

        // $message = Cache::remember("messages.{$id}", 5, function() use ($id) {
        // $message = Cache::tags('messages')->rememberForever("messages.{$id}", 5, function() use ($id) {
        //     return Message::findOrFail($id);
        // });

        // Con repositorio
        $message = $this->messages->findById($id);

        return $this->view->make('messages.show', compact('message'));

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
        // $message = Message::findOrFail($id);

        // $message = Cache::remember("messages.{$id}", 5, function() use ($id) {
        // $message = Cache::tags('messages')->rememberForever("messages.{$id}", function() use ($id) {
        //     return Message::findOrFail($id);
        // });

        //Con repositorio
        $message = $this->messages->findById($id);

        return $this->view->make('messages.edit', compact('message'));

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

        // $message = Message::findOrFail($id);
        // $message->update($request->all());

        // Cache::tags('messages')->flush();


        // con repositorio
        $this->messages->update($request, $id);

        // Redireccionar
        return $this->redirect->route('mensajes.index');

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
        // $message = Message::findOrFail($id);
        // $message->delete();

        // Cache::tags('messages')->flush();

        // Repositorio
        $this->messages->destroy( $id );

        // Redireccionar
        return $this->redirect->route('mensajes.index');

    }
}
