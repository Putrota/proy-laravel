{!! csrf_field() !!}

<div class="form-group">		
	<label for="nombre" >Nombre

	<input class="form-control" type="text" name="name" value="{{ $user->name or old('name') }}">

	{!! $errors->first('name', '<span class="error">:message</span>') !!}

	</label>
</div>

<div class="form-group">
	<label for="email" >Email

	<input class="form-control" type="text" name="email" value="{{ $user->email or old('email')}}">

	{!! $errors->first('email', '<span class="error">:message</span>') !!}

	</label>
</div>

@unless($user->id)

	<div class="form-group">		
		<label for="password" >Password

		<input class="form-control" type="password" name="password" >

		{!! $errors->first('password', '<span class="error">:message</span>') !!}

		</label>
	</div>


	<div class="form-group">		
		<label for="password_confirmation" >Password Confirm

		<input class="form-control" type="password" name="password_confirmation" >

		{!! $errors->first('password_confirmation', '<span class="error">:message</span>') !!}

		</label>
	</div>

@endunless

<div class="form-group">
	@foreach($roles as $id => $role)
		<label for="role" > {{ $role }}
			<input 
				type="checkbox" 
				name="roles[]" 
				value="{{ $id }}"
				{{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}
			>			
		</label>
	@endforeach

	{!! $errors->first('roles', '<span class="error">:message</span>') !!}

</div>


<hr>

<button type="submit" class="btn btn-primary">{{ $btnText or 'Guardar' }}</button>