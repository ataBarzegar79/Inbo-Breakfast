@extends('layout.app')

@section('avatar')
    {{$user->viewAvatar()}}
@endsection
@section('username')
    {{$user->name}}

@endsection
@section('content')
    <p>Please give your Vote and Comment to breakfast with this Info :</p>
    <p>Breakfast Name : {{$breakfast->name}}</p>
    <p>Date of Breakfast  : {{$breakfast->created_at}}  </p>
    <p>Done by : {{$breakfast->user->name}}   </p>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="p-5">
                <form class="user" method="POST"  action="{{route('breakfsatvotes.vote.store',$breakfast->id)}}" style="display: block">
                    @csrf
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
                </form>
            </div>
        </div>
    </div>
@endsection
