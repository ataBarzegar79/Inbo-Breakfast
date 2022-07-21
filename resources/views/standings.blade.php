@extends('layout.app')



@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inbo Breakfast Standings  !  ({{averageParticipationUsers()}}  average participating)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Joind From :</th>
                        <th>Performance</th>
                        <th>Has Role </th>
                        <th>Avarage Participation</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        @php
                        $counter = 0 ;
                        @endphp
                        @foreach($users as $user)

                            <td>{{$counter+=1}}</td>
                            <td> <img class= " center img-profile rounded-circle " width="60" height="60" src = {{$user[1]->viewAvatar()}}> </td>
                            <td>{{$user[1]->name}}</td>
                            <td class="text-center">{{persianFormat($user[1]->created_at)}}</td>
                            <td class="text-center" style="background-color: {{$user[1] -> performance()['color']}}">{{$user[1] -> performance()['rate']}}</td>
                            <td> <span class="font-weight-bolder" >{{$user[1]->countBreakfasts()}}</span>  breakfasts</td>

                            @if($user[0]>averageParticipationUsers())
                                <td class="alert-success text-center"><span class="font-weight-bold">{{$user[0]*10 }} XP</span></td>
                            @else
                                <td class="alert-danger text-center"><span class="font-weight-bold">{{$user[0]*10 }} XP</span></td>
                            @endif



                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
