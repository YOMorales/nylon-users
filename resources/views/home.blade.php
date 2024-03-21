@extends('layouts.base')
@section('title', 'Home')

@section('content')
    <p class="text-body-2 mb-4">
        Nylon Users: Please fill the information below.
    </p>

    <div id='vue_container' class='w-100 mt-10 bg-white rounded-lg'>
        <user-create></user-create>
    </div>
@endsection
