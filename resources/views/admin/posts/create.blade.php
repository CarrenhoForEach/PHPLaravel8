@extends('admin.layouts.app')

@section('title', 'Página criação de Post')

@section('content')

    <h1 class="text-center text-3x1 uppercase font-black my-4">Página de criação de posts</h1>

    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12 mx-auto">
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token()}}"/> --}}
            @include('admin.posts._partials.form')
            {{--<input type="text" name="title" id="title" placeholder="Título" value="{{ old('title') }}" />
            <br/>
            <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{ old('content') }}</textarea>
            <br/>
            <button type="submit">Enviar</button>--}}
    
        </form>

    </div>
    
    
@endsection

