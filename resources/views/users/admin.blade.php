@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endsection

@section('scripts')

@endsection

@section('content')
    <h2>Admin</h2>
    <a href="{{ route('logout') }}">Вихід</a>
@endsection