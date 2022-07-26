@extends('layout.form')

@section('form-subject')
    Create New Breakfast !
@endsection

@section('form')


<form class="user" method="POST"  action="{{route('breakfast.save')}}"
      style="margin-right: 50px ; margin-left: 50px"
      enctype="multipart/form-data">
    @csrf
    <div class="form-group ">
        <input type="text"
               class="form-control form-control-user"
               id="name"
               name="name"
               value="{{old('name')}}"
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
               value="{{old('date')}}"
               placeholder="Set date  ">
    </div>
    @error('date')
    <p style="color: red">
        {{$message}}
    </p>
    @enderror
    <span id="date2"></span>

    <div class="form-group">
        <label class="col-form-label" for="user">Maker(s):You can select multiple makers </label>
        <br>
            <select name="users[]" id="example-getting-started" class="multiselect-group" multiple >
                @foreach($users as $user)
                <option @if($user->average < averageParticipationUsers()) class="alert-danger" @endif value="{{$user->id}}">{{$user->name}} - {{$user->average}}</option>
                @endforeach
            </select>

    </div>


    @error('users')
    <p style="color: red">
        {{$message}}
    </p>
    @enderror

    <input class="btn btn-primary btn-user btn-block" style="font-size:18px "  type="submit" value="Save">
</form>




@endsection


