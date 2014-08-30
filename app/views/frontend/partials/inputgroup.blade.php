<div class="form-group {{$var = $errors->first( $key )}} {{ ($var !== '') ? 'has-error' : ''}}">
	{{ $controls['label'] }}
	<div class="col-sm-4">
		{{ $controls['input'] }}
	</div>
	<span class="help-block">{{$errors->first($key)}}</span>
</div>