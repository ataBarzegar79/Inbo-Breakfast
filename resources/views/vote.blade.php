@extends('layout.app')

@section('username')
    {{$user->name}}

@endsection
@section('content')
    <p>Please give your Vote and Comment to breakfast with name of << {{$breakfast->name}} >> that served at   {{$breakfast->created_at}}   by
        {{$breakfast->user->name}}!  </p>
<div style="text-align: center">
    <form class="user" method="POST"  action="{{route('breakfsatvotes.users.store',$breakfast->id)}}" style="display: block">
        @csrf
        @method('POST')
        <div class="form-group">
            <input type="number"
                   style="width: 300px"
                   class="form-control form-control-user"
                   id="rate"
                   name="rate"
                   value="{{old('rate')}}"
                   aria-describedby="emailHelp"
                   placeholder="Enter your Rate.. ">
        </div>
        @error('rate')
        <p style="color: red">
            {{$message}}
        </p>
        @enderror


        <div class="form-group">
            <textarea type="text"
                   style="width: 300px"
                   class="form-control form-control-user"
                   id="description"
                   name="description"
                   value="{{old('description')}}"
                   aria-describedby="emailHelp"
                   placeholder="Enter your Description "></textarea>
        </div>
        @error('description')
        <p style="color: red">
            {{$message}}
        </p>
    @enderror

        <input class="btn btn-primary btn-user btn-block" type="submit" value="Submit Rate" style="width: 300px;align-content: center">
</div>
@endsection
