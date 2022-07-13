@extends('layout.app')

@section('avatar')
{{$auth_user->viewAvatar()}}
@endsection

@section('username')
{{$auth_user->name}}
@endsection

@section('content')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" >
                        <div class="p-5" >
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create New Breakfast!</h1>
                            </div>
                            <form class="user" method="POST"  action="{{route('breakfast.save')}}"
                                  style="margin-right: 50px ; margin-left: 50px"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control form-control-user"
                                           id="name"
                                           name="name"
                                           value=""
                                           aria-describedby="emailHelp"
                                           placeholder="Breakfast Name" >
                                </div>

                                @error('name')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror


                                <div class="form-group">
                                    <textarea type="text"
                                           class="form-control form-control-user"
                                           name="description"
                                           id="descrition"
                                           value="{{old("description")}}"
                                              placeholder="Some Description"></textarea>
                                </div>


                                @error('description')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror




                                <div class="form-group">
                                    <input type="text"
                                           class="form-control form-control-user"
                                           name="date"
                                           id="date"
                                           value=""
                                           placeholder="Set date  ">
                                </div>
                                @error('date')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror
                                <span id="date2"></span>

                                <div class="form-group">
                                    <label class="col-form-label" for="user">Maker:</label>
                                        <select name="user" id="user" class="custom-select">
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>

                                </div>


                                @error('user')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror

                                <input class="btn btn-primary btn-user btn-block" style="font-size:18px " type="submit" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


