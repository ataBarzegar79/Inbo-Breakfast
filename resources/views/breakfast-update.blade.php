@extends('layout.form')

@section('form-subject')
@endsection

@section('form')

<div class="container ">
    <div class="row justify-content-center " >
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-sm my-5">
                <div class="card-body p-0" >
                    <div class="p-5  alert-info" >
                        <div class="text-center">
                            <h1 class="h4 text-white-900 mb-4">Please Update  breakfast with this Info :</h1>
                        </div>
                        <div class="text-center">
                            <p>Breakfast Name : {{$breakfast->name}}</p>
                            <p>Date of Breakfast  : {{persianFormat($breakfast->created_at)}} </p>
                            <p class="font-weight-bolder  ">Done by :  @foreach($breakfast->users as $user)
                                    {{$user->name}} |
                                @endforeach</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div style="margin-left: 100px ;margin-right: 100px ">
    <form class="user" method="POST"  action="{{route('breakfast.edit',  $breakfast->id)}}"
          style="margin-right: 50px ; margin-left: 50px">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group ">
            <input type="text"
                   class="form-control form-control-user"
                   id="name"
                   name="name"
                   value="{{$breakfast->name}}"
                   aria-describedby="emailHelp"
                   >
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
              id="description"
              value="{{$breakfast->description}}"
              >{{$breakfast->description}}</textarea>
        </div>


        @error('description')
        <p style="color: red">
            {{$message}}
        </p>
        @enderror




{{--        <div class="form-group">--}}
{{--            <input type="text"--}}
{{--                   class="form-control form-control-user"--}}
{{--                   name="date"--}}
{{--                   id="date"--}}
{{--                   placeholder="Set date  ">--}}
{{--        </div>--}}
{{--        @error('date')--}}
{{--        <p style="color: red">--}}
{{--            {{$message}}--}}
{{--        </p>--}}
{{--        @enderror--}}
{{--        <span id="date2"></span>--}}

        <div class="form-group">
            <label class="col-form-label" for="user">Maker(s):You can select multiple makers </label>
            <br>
            <select name="users[]" id="example-getting-started" class="multiselect-group" multiple >
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
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



</div>

@endsection
