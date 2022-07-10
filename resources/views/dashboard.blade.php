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
                @foreach($breakfasts as $breakfast)

                    <td>{{$breakfast->name}}</td>
                    <td>{{$breakfast->description}}</td>
                    <td>{{$breakfast->created_at}}</td>
                    <td>{{$breakfast->user->name}}</td>
                    <td>{{$breakfast->avareageRate()}}</td>
                    <td>
                        @php $flag = 0; @endphp
                        @foreach($breakfast->rates as $rate)
                            @if($rate->user_id == $user->id)

                                {{$rate->rate}}
                                @php $flag = 1 ; @endphp
                                @break

                            @endif
                        @endforeach
                            @php
                        if($flag == 0){
                            echo "  <p> Vote! From This  <a href='breakfsatvotes/$breakfast->id/users/create '>Link</a> .</p>" ;
                            }
                            @endphp
                    </td>
                    <td>
                        @if($rate->user_id == $user->id)
                        {{$rate->description}}
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

