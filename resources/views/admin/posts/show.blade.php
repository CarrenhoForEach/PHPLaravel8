@extends('admin.layouts.app')

@section('title','Página de Detalhes do Post')

@section('content')

    <h1>Detalhes do Post {{ $post->title }}</h1>

    <ul>
        <li><strong>Título: </strong> {{ $post->title }}</li>
        <li><Strong>Imagem: </Strong> <img src="{{url("storage/$post->image")}}" alt="{{ $post->title }}" style="max-width:100px;"/></li>
        <li><strong>Conteúdo: </strong> {{ $post->content }}</li>
    </ul>

    <form action="{{ route('posts.destroy', ['id' => $post->id ])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE" />
        <button style="background: #95abe6"; type="submit">Deletar o Post: {{ $post->title }}</button>
    </form>

    
@endsection

