@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div>
                            Dettagli post: <strong>{{ $post->title }}</strong>
                        </div>
                    </div>
                    
          
                    <div class="card-body">
                        <div class="post-image">
                            @if(isset($post->image))
                                <img class="img-fluid rounded" src="{{asset("storage/" . $post->image)}}" alt="post image">
                            @elseif($post->imageLink)
                                <img class="img-fluid rounded" src="{{ $post->imageLink }}" alt="post image">
                            @endif
                        </div>
                        <strong>Content:</strong>
                        {{ $post->content }}
                        <div>
                            <strong>Utente: </strong>{{ $post->user->name }}
                            <br />
                            <strong>Email: </strong>{{ $post->user->email }}
                            <br />
                            <strong>Data di creazione: </strong>{{ $post->created_at->format("d-m-Y") }}
                            <br />
                            <strong>Ultima modifica: </strong>{{ $post->updated_at }} ({{ $post->updated_at->diffForHumans(date(0)) }})
                            <br />
                            <strong>Categoria: </strong> 
                            @if (isset($post->category)) 
                                {{ $post->category->name }}
                            @else
                                <span>Nessuna categoria</span>
                            @endif
                            <br />
                            <strong>Tags: </strong>
                            @forelse ($post->tags as $tag)
                                <span> {{$tag->name}}, </span>
                            @empty
                                <span>Nessun Tag Inserito</span>              
                            @endforelse
                        </div>
                    </div>
                    <div class="d-flex justify-content-center p-3">
                        @if(!$post->trashed())
                            @include('partials.archiveButton', [
                                "route"=>"admin.posts.archive",
                                "id"=>$post->id,
                            ])   
                            <a class="btn btn-outline-secondary mx-2" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>    
                        @endif
                        @include('partials.deleteButton', [
                            "route"=>"admin.posts.destroy",
                            "id"=>$post->id,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
