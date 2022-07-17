@extends('layout.app')


@section('content')

@yield('preform')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" >
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0" >
                    <div class="p-5" >
                        <div class="text-center">
                            <h1 class="h4 text-white-900 mb-4">@yield('form-subject')  </h1>
                        </div>
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @yield('postform')
@endsection

