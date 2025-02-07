@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-4">Admin Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>
    </div>
@endsection
