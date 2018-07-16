<?php


namespace App\Repositories;

use App\Message;


class Messages implements MessagesInterface
{


	public function getPaginated()
	{

		return Message::with(['user', 'note', 'tags'])
                ->orderBy('created_at', request('sorted', 'DESC'))
                ->paginate(10);        

	}


	public function store($request)
	{

		$message = Message::create($request->all());

        if( auth()->check() ) {
            auth()->user()->messages()->save($message);
        }

        return $message;

	}


	public function findById( $id )
	{

		return Message::findOrFail($id);

	}


	public function update($request, $id)
	{

		$message = Message::findOrFail($id);
        $message->update($request->all());

        return $message;

	}


	public function destroy( $id )
	{

		$message = Message::findOrFail($id);
        $message->delete();        

        return $message;

	}


}