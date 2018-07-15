<?php


namespace App\Repositories;

use App\Message;
use Illuminate\Support\Facades\Cache;


class Messages
{


	public function getPaginated()
	{

		$key = 'message.page.' . request('page', 1);

        return Cache::tags('messages')->rememberForever($key, function() {
            return Message::with(['user', 'note', 'tags'])
                    ->orderBy('created_at', request('sorted', 'DESC'))
                    ->paginate(10);
        });

	}


	public function store($request)
	{

		$message = Message::create($request->all());

        if( auth()->check() ) {
            auth()->user()->messages()->save($message);
        }

        Cache::tags('messages')->flush();

        return $message;

	}


	public function findById( $id )
	{

		return Cache::tags('messages')->rememberForever("messages.{$id}", 5, function() use ($id) {
            return Message::findOrFail($id);
        });

	}


	public function update($request, $id)
	{

		$message = Message::findOrFail($id);
        $message->update($request->all());

        Cache::tags('messages')->flush();

        return $message;

	}


	public function destory( $id )
	{

		$message = Message::findOrFail($id);
        $message->delete();

        Cache::tags('messages')->flush();

        return $message;

	}


}