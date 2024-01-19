@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />

{{--     @forelse ($posts as $post)
        <h1>{{ $post->titulo }}</h1>
    @empty
        No hay posts
    @endforelse --}}
@endsection