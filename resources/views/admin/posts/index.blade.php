@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($posts as $post)  
                    <div class="card">
                        {{-- CARD HEADER --}}
                        <div class="card-header">{{ __('Dashboard') }}</div>
                        {{-- CARD BODY --}}
                        <div class="card-body">
                                Card Post {{$post->title}}
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>

    <a href="{{ route('admin.posts.create') }}">Aggiungi nuovo Post</a>
@endsection