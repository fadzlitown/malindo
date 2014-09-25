@extends('frontend.layouts.dashboard')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    @include('frontend.partials.notification')
    @include('frontend.posts.forms.media')
</div>
@stop