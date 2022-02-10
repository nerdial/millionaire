@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @auth
                    @section('content')
                        <router-view></router-view>
                    @endsection
                @endauth

                @guest
                    <div class="card">
                        <div class="card-header">Information</div>
                        <div class="card-body">
                            Welcome to the party ,
                            you need to login first, if you want a game
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
@endsection



