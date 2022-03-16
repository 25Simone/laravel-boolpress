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
                <strong>Content:</strong>
                {{ $post->content }}
                <div>
                  <strong>Utente: </strong>{{ $post->user->name }}
                  <br />
                  <strong>Email: </strong>{{ $post->user->email }}
                  <br />
                  <strong>Data di creazione: </strong>{{ $post->created_at }}
                  <br />
                  <strong>Ultima modifica: </strong>{{ $post->updated_at }}
                  <br />
                  <strong>Categoria: </strong> 
                  @if (isset($post->category)) 
                    {{ $post->category->name }}
                    @else
                    <span>Nessuna categoria</span>
                  @endif
                  <br />
                  <strong>Tags: </strong>
                  @foreach ($post->tags as $tag)
                    <span> {{$tag->name}}, </span>                
                  @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center p-3">
                <a class="btn btn-outline-secondary mx-2" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
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
