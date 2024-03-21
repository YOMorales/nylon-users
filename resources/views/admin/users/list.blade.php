@extends('layouts.base')
@section('title', 'Admin Users List')

@section('content')
    <p class="text-body-2 mb-4">
        Admin Users List
    </p>

    <a href="{{ route('users.home') }}" class="pa-2 mb-4 bg-orange-darken-4 text-white text-decoration-none rounded">
        Back to Create User
    </a>

    <div id='vue_container' class='w-100 mt-10 bg-white rounded-lg'>
        <users-list></users-list>
    </div>
@endsection
