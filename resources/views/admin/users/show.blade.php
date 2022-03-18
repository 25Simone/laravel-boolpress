@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div>
                        <strong>{{ $user->name }}</strong>
                    </div>
                </div>
      
                <div class="card-body d-flex align-items-center justify-content-around">
                    <div class="user-avatar">
                        @if(isset($user->infoUser->avatar))
                            <img class="img-fluid rounded-circle" src="{{ $user->infoUser->avatar }}" alt="post image">
                        @endif
                    </div>
                    <div>
                        @if($user->infoUser)
                            <strong>Email: </strong>{{ $user->email }}
                            <br />
                            <strong>Phone: </strong>{{ $user->infoUser->phone }}
                            <br />
                            <strong>Address: </strong>{{ $user->infoUser->address }}
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-center p-3">
                    <a class="btn btn-outline-secondary mx-2" href="{{ route('admin.users.edit', $user->id) }}">Modifica</a>
                    {{-- @include('partials.deleteButton', [
                        "route"=>"admin.users.destroy",
                        "id"=>$user->id,
                    ]) --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection