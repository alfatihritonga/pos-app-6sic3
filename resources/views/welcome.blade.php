@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Halaman Utama</h1>
    <p>Paragraf pertama</p>
    {{ Auth::user()->name }}
@endsection