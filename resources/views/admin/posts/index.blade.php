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
                            <div class="d-flex fs-6">
                                <a class="nav-link" href="{{ route('admin.posts.edit', $post->id) }}" title="edit"><i class="fas fa-edit"></i></a>
                                <a class="nav-link" href="{{ route('admin.posts.show', $post->slug) }}" title="details"><i class="fas fa-eye"></i></a> 
                            </div>
                        </div>
                        {{-- CARD BODY --}}
                        <div class="card-body">
                            <div><strong>Content:</strong> {{ $post->content }}</div>
                            <div>
                                {{ $post->user->name }} - 
                                @if(isset($post->category->name))
                                    {{ $post->category->name }}
                                @endif; 
                                @if($post->updated_at->diffInHours(date(0)) <= 12)
                                    {{ $post->updated_at->diffForHumans(date(0)) }}
                                    @else
                                    {{$post->updated_at->format("d-m-Y")}}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>    
        </div>
    </div>

@endsection