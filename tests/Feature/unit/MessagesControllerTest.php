<?php

// namespace Tests\Feature\unit;

// use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\MessagesController;

class MessagesControllerTest extends PHPUnit_Framework_TestCase
{


	public function setUp()
	{

		$this->messagesRepo = Mockery::mock('App\Repositories\MessagesInterface');
        $this->view = Mockery::mock('Illuminate\View\Factory');
        $this->redirect = Mockery::mock('Illuminate\Routing\Redirector');
        $this->request = Mockery::mock('Illuminate\Http\Request');

    	$this->controller = new MessagesController($this->messagesRepo, $this->view, $this->redirect);

	}


	public function tearDown()
	{

		Mockery::close();

	}


	public function testIndex()
    {
        
        // Asegurarme de que el messages repository llame al método get paginated
    	$this->messagesRepo->shouldReceive('getPaginated')->once()->andReturn('paginated_messages');

    	// Asegurarnos de que el método make sea llamado a través del view factory
    	// Y que por parámetro reciba la vista messages.index y la variable messages

    	$this->view->shouldReceive('make')
    		->with('messages.index', ['messages' => 'paginated_messages'])
    		->once();

    	$this->controller->index();


    }


    public function testCreate()
    {

        $this->view->shouldReceive('make')
    		->with('messages.create')
    		->once();

    	$this->controller->create();

    }


    public function testStore()
    {
    	
    	$event = Mockery::mock('Illuminate\Events\Dispatcher');
    	$messageEvent = Mockery::type('App\Events\MessageWasReceibed');

    	$this->messagesRepo->shouldReceive('store')->once()
    		->with($this->request)
    		->andReturn('saved_message');
    	$event->shouldReceive('fire')->once()
    	->with(Mockery::on(function($param){
    		return $param instanceof App\Events\MessageWasReceibed
    			&& $param->message == 'saved_message';
    	}));
    	// $messageEvent instanceof App\Events\MessageWasReceibed


    	$this->redirect
    		->shouldReceive('route')
    		->once()
    		->with('mensajes.create')
    		->andReturn($this->redirect);
		$this->redirect
			->shouldReceive('with')
			->once()
			->with('info', 'Hemos recibido tu mensaje');

    	$this->controller->store($this->request, $event);

    }


    public function testShow()
    {

    	$id = 1;

    	$this->messagesRepo->shouldReceive('findById')->once()->with($id)->andReturn('finded_message');
    	$this->view->shouldReceive('make')->once()->with('messages.show', ['message' => 'finded_message']);

    	$this->controller->show($id);

    }


    public function testEdit()
    {

    	$id = 1;

    	$this->messagesRepo->shouldReceive('findById')->once()->with($id)->andReturn('finded_message');
    	$this->view->shouldReceive('make')->once()->with('messages.edit', ['message' => 'finded_message']);

    	$this->controller->edit($id);

    }


    public function testUpdate()
    {

    	$id = 1;

    	$this->messagesRepo
    		->shouldReceive('update')
    		->once()
    		->with($this->request, $id)
    		->andReturn('finded_message');

    	$this->redirect->shouldReceive('route')->once()->with('mensajes.index');

    	$this->controller->update($this->request, $id);

    }


	public function testDestroy()
    {

    	$id = 1;

    	$this->messagesRepo
    		->shouldReceive('destroy')
    		->once()
    		->with($id);

    	$this->redirect->shouldReceive('route')
    		->once()
    		->with('mensajes.index');

    	$this->controller->destroy($id);

    }


}
