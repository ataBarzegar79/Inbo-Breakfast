@extends('layout.app')



@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" >
                        <div class="p-5" >
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Update User!</h1>
                            </div>
                            <form class="user" method="POST"  action="{{route('users.update' , $update_user->id )}}"
                                  style="margin-right: 50px ; margin-left: 50px"
                                  enctype="multipart/form-data">
                                @csrf
                                {{method_field('PUT') }}
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control form-control-user"
                                               id="name"
                                               name="name"
                                               value="{{$update_user->name}}"
                                               aria-describedby="emailHelp"
                                               placeholder="Name : {{$update_user->name}}">
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
                                           value="{{$update_user->email}}"
                                           placeholder="Email : {{$update_user->email}}">
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
                                           value="{{$update_user->password}}"
                                           placeholder="Password : {{$update_user->password}}">
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
@endsection
