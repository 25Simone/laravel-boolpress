@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-center">
                <a role="button" class="fw-bold btn btn-success" href="{{ route('admin.posts.create') }}">Aggiungi nuovo Post</a>
            </div>
            <div class="col-md-8">
                @foreach ($posts as $post)  
                    <div class="card my-3">
                        {{-- CARD HEADER --}}
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>{{$post->title}}</div>
                            <div class="d-flex">
                                <a class="nav-link" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
                                <a class="nav-link" href="{{ route('admin.posts.show', $post->slug) }}">Dettagli</a>
                            </div>
                        </div>
                        {{-- CARD BODY --}}
                        <div class="card-body">
                            <div><strong>Content:</strong> {{ $post->content }}</div>
                            <div>{{ $post->user->name }}; {{ $post->updated_at }}</div>
                        </div>
                    </div>
                @endforeach
            </div>    
        </div>
    </div>

@endsection