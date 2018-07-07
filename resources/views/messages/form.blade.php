{!! csrf_field() !!}

@if ( $showFields )

	<div class="form-group">			
		<label for="nombre" >Nombre

		<input type="text" class="form-control" name="nombre" value="{{ $message->nombre or old('nombre') }}">

		{!! $errors->first('nombre', '<span class="error">:message</span>') !!}

		</label>
	</div>

	<div class="form-group">
		<label for="email" >Email

		<input type="text" class="form-control" name="email" value="{{ $message->email or old('email') }}">

		{!! $errors->first('email', '<span class="error">:message</span>') !!}

		</label>
	</div>

@endif

<div class="form-group">
	<label for="mensaje" >Mensaje

	<textarea class="form-control" name="mensaje" >{{ $message->mensaje or old('mensaje') }}</textarea>

	{!! $errors->first('mensaje', '<span class="error">:message</span>') !!}

	</label>
</div>

<button type="submit" class="btn btn-primary">{{ $btnText or 'Guardar' }}</button>