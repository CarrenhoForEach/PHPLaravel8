@extends('admin.layouts.app')

@section('title', 'Página de Editar o Post')

@section('content')

    <h1>Página de Editar o Post <strong>{{ $post->title }}</strong></h1>




    <form action="{{ route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
        {{-- <input type="hidden" name="_token" value="{{ csrf_token()}}"/> --}}
        
        @method('PUT')
        @include('admin.posts._partials.form')

    </form>
    
@endsection
