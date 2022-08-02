@extends('layout.app')



@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inbo Breakfast Standings ! ({{ $usersAverage * 10 }}) average
                participating)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="text-align: center">
                        <th></th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Joined From:</th>
                        <th>Performance</th>
                        <th>Has Role</th>
                        <th>Average Participation</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        @php
                            $counter = 0 ;
                        @endphp
                        @foreach($users as $user)
                            <td style="text-align: center">{{$counter+=1}}</td>
                            <td style="text-align: center">
                                <img class=" center img-profile rounded-circle " width="60" height="60"
                                     src={{$user->avatar}} alt="">
                            </td>
                            <td style="text-align: center">{{$user->name}}</td>
                            <td class="text-center" style="text-align: center">{{$user->createdAt}}</td>
                            <td class="text-center"
                                style="background-color:
                                @if($user->rate >=1 && $user->rate<=4 )
                                    #ff8080
                                @elseif($user->rate >4 && $user->rate<=6)
                                    #f6c23e
                                @elseif($user->rate >6 && $user->rate<=10)
                                    #1cc88a
                                @else
                                    #f8f9fc
                                @endif; text-align: center; color: black">{{$user->rate}}</td>
                            <td><span class="font-weight-bolder">{{$user->countBreakfast}}</span> breakfasts</td>

                            @if($user->averageParticipating > $usersAverage)
                                <td class="alert-success text-center" style="text-align: center">
                                    <span class="font-weight-bold">{{$user->averageParticipating*10 }} XP</span>
                                </td>
                            @else
                                <td class="alert-danger text-center" style="text-align: center">
                                    <span class="font-weight-bold">{{$user->averageParticipating*10 }} XP</span>
                                </td>
                            @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
