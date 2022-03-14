@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3>
                    Dettagli post: {{ $post->title }}
                </h3>
            </div>
  
            <div class="card-body">
                <strong>Content:</strong>
                {{ $post->content }}
            </div>
            <div class="d-flex justify-content-center p-3">
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
