@extends('layout.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Breakfasts Done!</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date of Operation</th>
                    <th>Done by</th>
                    <th>Rate</th>
                    <th>Your Rate</th>
                    <th>Your comment</th>
                    @can('is_admin')
                    <th>Functionalities </th>
                    @endcan
                </tr>
                </thead>

                <tbody>
                <tr>
                @foreach($breakfasts->data as $breakfast)

                    <td>{{$breakfast->name}}</td>
                    <td>{{$breakfast->description}}</td>
                    <td>{{$breakfast->createdAt}}</td>
                    <td>@foreach($breakfast->users as $user)
                        {{$user->name}} @if($user === end($breakfast->users)) @else | @endif
                        @endforeach
                    </td>

                    <td>{{$breakfast->averageRate}}</td>
                    <td>
                        @if( $breakfast->userRate !== null )
                            {{$breakfast->userRate->rate}}
                        @else
                            <p> Vote! From This  <a href='{{route('breakfsatvotes.vote.create', $breakfast->id )}}'>Link</a> .</p>
                        @endif
                    </td>
                    <td>
                        @if($breakfast->userRate !== null)
                            {{$breakfast->userRate->description}}
                        @endif
                    </td>
                    @can('is_admin')
                    <td>
                        <div>
                            <form  method="POST" action="{{route('breakfast.delete' , $breakfast->id)}}" >

                                @csrf
                                {{ method_field('DELETE') }}
                                <button class="  btn btn-danger btn-circle btn-sm"  type="submit" >
                                    <i class="fas fa-trash"></i>
                                </button>  Delete
                            </form>
                        </div>
                        <br>
                        <div>
                            <a href="{{route('breakfast.update' ,$breakfast->id )}}" class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-exclamation-triangle"></i>
                            </a>   Update
                        </div>
                    </td>
                        @endcan
                </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<span>
</span>
<div >
</div>

@endsection
