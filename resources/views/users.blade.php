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
                                <h1 class="h4 text-gray-900 mb-4">Create User!</h1>
                            </div>
                            <form class="user" method="POST"  action="{{route('users.store')}}"
                                  style="margin-right: 50px ; margin-left: 50px"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control form-control-user"
                                           id="name"
                                           name="name"
                                           value="{{old('name')}}"
                                           aria-describedby="emailHelp"
                                           placeholder="Enter Username...">
                                </div>
                                @error('name')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror


                                <div class="form-group">
                                    <input type="email"
                                           class="form-control form-control-user"
                                           name="email"
                                           id="email"
                                           value="{{old('email')}}"
                                           placeholder="Email">
                                </div>


                                @error('email')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror

                                <div class="form-group">
                                    <input type="password"
                                           class="form-control form-control-user"
                                           name="password"
                                           id="password"
                                           value="{{old('password')}}"
                                           placeholder="Password">
                                </div>


                                @error('password')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror


                                <div class="form-group">
                                    <label>Avatar :
                                    <input type="file"
                                           name="avatar"
                                           id="avatar"
                                           value="{{old('avatar')}}"
                                    >
                                    </label>
                                </div>


                                @error('avatar')
                                <p style="color: red">
                                    {{$message}}
                                </p>
                                @enderror

                                <div class="form-group">
                                    <label>
                                        Admin :
                                    <select
                                        placeholder="Admin"
                                        id="is_admin" name="is_admin">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                        </label>
                                </div>

                                @error('is_admin')
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




    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inbo Users !</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Creation Time</th>
                        <th>Is Admin</th>
                        <th>Performance</th>
                        <th>Avatar</th>
                        <th>Functionalities</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        @foreach($users as $user)

                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->is_admin}}</td>
                            <td style="background-color: {{$user -> performance()['color']}}">{{$user -> performance()['rate']}}</td>
                            <td> <img class= " center img-profile rounded-circle " width="60" height="60" src = {{$user ->viewAvatar()}}> </td>

                            <td>
                                <div>
                                    <form  method="POST" action="{{route('users.destroy' , $user->id)}}" >

                                     @csrf
                                      {{ method_field('DELETE') }}
                                        <button class="  btn btn-danger btn-circle btn-sm"  type="submit" >
                                            <i class="fas fa-trash"></i>
                                        </button>  Delete
                                    </form>
                                </div>
                                <br>
                                <div>
                                        <a href="{{route('users.edit' ,$user->id )}}" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>   Update
                                </div>
                            </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
