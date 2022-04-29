@extends('admin.layouts.app')

@section('title', 'Listagem dos Posts')

@section('content')

    <a style="background: #95abe6"; href="{{route('posts.create')}}">Novo Post</a>
    <hr/>

    @if (session('message'))

        <div>
            {{session('message')}}
        </div>
        
    @endif

    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" placeholder="Filtrar: "/>
        <button style="background: #95abe6"; type="submit">Filtrar</button>
    </form>

    <h3>Posts</h3>

    @foreach ($posts as $post)

        {{-- <p>{{ $post->title }} - [ <a href="{{route('posts.show', $post->id)}}">Ver</a> ] </p> --}}
        <p>{{ $post->title }} - [ <a style="background: #c95b2c;" href="{{route('posts.show', ['id' => $post->id ])}}">Ver</a> 
                                | <a style="background: #c95b2c;" href=" {{route('posts.edit', $post->id )}}">Edit</a>  ]</p>
                                <form action="{{ route('posts.destroy', ['id' => $post->id ])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button style="background: #95abe6"; type="submit">Deletar: {{ $post->title }}</button>
                                </form>
                                
                               
        <br/>
        <img src="{{url("storage/$post->image")}}" alt="{{ $post->title }}" style="max-width:100px;"/>
        <p>{{ $post->content }}</p>
        <br/>
    @endforeach

    <hr/>

    @if(isset($filters))
        {{ $posts->appends($filters)->links() }}
    @else
        {{ $posts->links() }}
            
    @endif


    
@endsection

