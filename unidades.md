unidades de aprendizaje

####################################################################3
Relaciones polimofica many to many

php artisan make:model Tag -m
php artisan make:migration create_taggables_table --create=taggables
php artisan migrate

Migración pivote

	Schema::create('taggables', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('tag_id');
        $table->integer('taggable_id');
        $table->string('taggable_type');
        $table->timestamps();
    });


Tabla tag
		public function messages()
	{

		return $this->morphedByMany(Message::class, 'taggable');

	}
 
Tabla Message
    public function tags()
    {

    	return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    	// ->withTimestamps() es para que agregue los timestamps

    }



>>> $m = App\Message::first();
=> App\Message {#2330
     id: 1,
     nombre: "Moderador",
     email: "mod@email.php",
     phone: null,
     mensaje: "Esto es un mensaje",
     created_at: "2018-07-03 16:40:29",
     updated_at: "2018-07-03 16:40:29",
     user_id: null,
   }
>>> $m->tags()->create(['name' => 'importante']);
=> App\Tag {#108
     name: "importante",
     updated_at: "2018-07-06 06:37:30",
     created_at: "2018-07-06 06:37:30",
     id: 1,
   }
>>> $tag = App\Tag::create(['name' => 'no imortante']);
=> App\Tag {#2328
     name: "no imortante",
     updated_at: "2018-07-06 06:39:43",
     created_at: "2018-07-06 06:39:43",
     id: 2,
   }
>>> $m->tags()->save($tag);
=> App\Tag {#2328
     name: "no imortante",
     updated_at: "2018-07-06 06:39:43",
     created_at: "2018-07-06 06:39:43",
     id: 2,
   }
>>> $m->tags
=> Illuminate\Database\Eloquent\Collection {#108
     all: [
       App\Tag {#2327
         id: 1,
         name: "importante",
         created_at: "2018-07-06 06:37:30",
         updated_at: "2018-07-06 06:37:30",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#2336
           taggable_id: 1,
           tag_id: 1,
           taggable_type: "App\Message",
         },
       },
       App\Tag {#2338
         id: 2,
         name: "no imortante",
         created_at: "2018-07-06 06:39:43",
         updated_at: "2018-07-06 06:39:43",
         pivot: Illuminate\Database\Eloquent\Relations\MorphPivot {#2325
           taggable_id: 1,
           tag_id: 2,
           taggable_type: "App\Message",
         },
       },
     ],
   }
>>> $m->tags()->detach(1); #para quitar una etiqueta

>>> $m->fresh()->tags; # para que devuelva una instancia fresca

>>> $u->tags()->save(App\Tag::find(2));


############################

Mostrar consultas mysql

DB::listen(function($query) {
	echo "<pre>{$query->sql}</pre>";
	// echo "<pre>{$query->time}</pre>";
});




#######################3
Eager loading
	$messages = Message::with(['user', 'note', 'tags'])->get();


##########################
Enviar un email con laravel

Mail::send('emails.contact', ['msg' => $message], function($m) use ($message){

    $m->to($message->email, $message->nombre)->subject('Tu mensaje fue recibido');

});


##########################
Inyectar una clase en un método
hay que importarla antes con un use, imagino que esto reemplaza a instanciar la clase dentro de la función

public function index( Messages $messages)
{

}

Inyectar en el constructor

    protected $messages;


    public function __construct(Messages $messages)
    {

      $this->messages = $messages;
      
    }


##############################
Llamar al view en el controller

protected $view;

public function __construct( \Illuminate\Contracts\View\Factory $view ){

public function index(){
  return $this->view->make('messages.index', compact('messages'));