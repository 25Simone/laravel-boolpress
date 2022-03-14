@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($posts as $post)  
                    <div class="card my-3">
                        {{-- CARD HEADER --}}
                        <div class="card-header">{{$post->title}}</div>
                        {{-- CARD BODY --}}
                        <div class="card-body">
                            <strong>Content:</strong>
                            {{ $post->content }}
                        </div>
                    </div>
                @endforeach
            </div>    
        </div>
    </div>

    <a href="{{ route('admin.posts.create') }}">Aggiungi nuovo Post</a>
@endsection