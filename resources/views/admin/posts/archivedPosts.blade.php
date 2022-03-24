@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center m-3">
            <div class="text-center">
                <span class="fw-bold bg-warning rounded p-2 fw-bold fs-3">Post archiviati</span>
            </div>
            <div class="col-md-8">
                @foreach ($posts as $post)  
                    <div class="card my-3">
                        {{-- CARD HEADER --}}
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>{{$post->title}}</div>
                            <div class="d-flex fs-6">
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