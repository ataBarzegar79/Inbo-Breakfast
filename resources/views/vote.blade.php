@extends('layout.form')

@section('preform')


@endsection

@section('form')

    <div class="container ">
        <div class="row justify-content-center " >
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" >
                        <div class="p-5  alert-info" >
                            <div class="text-center">
                                <h1 class="h4 text-white-900 mb-4">Please give your Vote and Comment to breakfast with this Info :</h1>
                            </div>
                            <div class="text-center">
                                <p>Breakfast Name : {{$breakfast->name}}</p>
                                <p>Date of Breakfast  : {{$breakfast->persian}}  </p>
                                <p class="font-weight-bolder  ">Done by :  @foreach($breakfast->users as $user)
                                        {{$user->name}}
                                    @endforeach</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <div style="margin-left: 100px ;margin-right: 100px ">
                <form class="user" method="POST"  action="{{route('breakfsatvotes.vote.store',$breakfast->id)}}" >
                    @csrf
                    <div class="form-group">
                        <input type="number"
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
                    <input class="btn btn-primary btn-user btn-block" type="submit" value="Submit Rate" >
                </form>
    </div>

@endsection
