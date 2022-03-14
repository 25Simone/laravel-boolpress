@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- CARD HEADER --}}
                    <div class="card-header d-flex"> <h3>Edit Post</h3> </div>

                    {{-- CARD BODY --}}
                    <div class="card-body">
                        {{-- FORM --}}
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                            @csrf
                            @method('put')

                            {{-- TITLE --}}
                            <div class="py-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter the title" value="{{ $post->title }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- POST CONTENT --}}
                            <div class="py-3">
                                <label>Content</label>
                                <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Write something..." required> {{ $post->content }} </textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success">Salva modifiche</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection