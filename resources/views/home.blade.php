@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ __('Welcome to our website', ['test' => 'hi Test']) }}</h1>
        </div>
    </div>
</div>
@endsection
