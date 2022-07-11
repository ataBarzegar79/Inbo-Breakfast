@extends('layout.app')


@section('username')
    {{$user->name}}
@endsection
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
                </tr>
                </thead>

                <tbody>
                <tr>
                @foreach($breakfasts as $breakfast)

                    <td>{{$breakfast->name}}</td>
                    <td>{{$breakfast->description}}</td>
                    <td>{{$breakfast->created_at}}</td>
                    <td>{{$breakfast->user->name}}</td>
                    <td>{{$breakfast->avareageRate()}}</td>
                    <td>
                        @if( $breakfast->userRate() !== null )
                            {{$breakfast->userRate()['rate']}}
                        @else
                            <p> Vote! From This  <a href='{{route('breakfsatvotes.vote.create', $breakfast->id )}}'>Link</a> .</p>
                        @endif
                    </td>
                    <td>
                        @if($breakfast->userRate() !== null)
                            {{$breakfast->userRate()['description']}}
                        @endif
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
