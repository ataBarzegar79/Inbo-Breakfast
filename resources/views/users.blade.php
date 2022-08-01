@extends('layout.form')

@section('form-subject')
    Create New User!
@endsection
@section('form')

    <form class="user" method="POST" action="{{route('users.store')}}"
          style="margin-right: 50px ; margin-left: 50px"
          enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Enter Username: </label>
            <input type="text"
                   class="form-control form-control-user"
                   id="name"
                   name="name"
                   value="{{old('name')}}"
                   aria-describedby="emailHelp"
                   placeholder="Enter Username">
        </div>
        @error('name')
        <p style="color: red">
            {{$message}}
        </p>
        @enderror


        <div class="form-group">
            <label for="email">Enter Email: </label>
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
            <label for="password">Enter Password: </label>
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
            <label for="name">Avatar: </label>
            <input type="file"
                   class="form-control-file form-control-user  "
                   name="avatar"
                   id="avatar"
                   value="{{old('avatar')}}">
        </div>


        @error('avatar')
        <p style="color: red">
            {{$message}}
        </p>
        @enderror

        <div class="form-group">
            <label for="is_admin">Admin: </label>
            <select
                placeholder="Admin"
                class=" form-control-sm"
                id="is_admin" name="is_admin">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>

        @error('is_admin')
        <p style="color: red">
            {{$message}}
        </p>
        @enderror

        <input class="btn btn-primary btn-user btn-block" style="font-size:18px " type="submit" value="Save">
    </form>

@endsection

@section('postform')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inbo Users !</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="text-align: center">
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
                        @foreach($users->data as $user)

                            <td style="text-align: center">{{$user->name}}</td>
                            <td style="text-align: center">{{$user->email}}</td>
                            <td style="text-align: center">{{$user->createdAt}}</td>
                            <td style="text-align: center">{{$user->isAdmin}}</td>
                            <td style="background-color: {{$user->color}}; text-align: center; color: black">{{$user->rate}}</td>
                            <td style="text-align: center">
                                <img class=" center img-profile rounded-circle " width="60"
                                     height="60"
                                     src={{$user->avatar}} alt="">
                            </td>

                            <td>
                                <div>
                                    <form method="POST" action="{{route('users.destroy' , $user->id)}}">

                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="  btn btn-danger btn-circle btn-sm" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        Delete
                                    </form>
                                </div>
                                <br>
                                <div>
                                    <a href="{{route('users.edit' ,$user->id )}}"
                                       class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a> Update
                                </div>
                            </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <ul class="-pager">
            <li class="previous"><a @if($users->links->prev)href="{{$users->links ->prev}}" @endif>Previous</a></li>
            <li class="next"><a @if($users->links->next)href="{{$users->links->next}}" @endif>Next</a></li>
        </ul>
    </div>

@endsection
