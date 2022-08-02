@extends('layout.form')

@section('form-subject')
    Update User !
@endsection
@section('form')

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
                   value="">
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

@endsection
