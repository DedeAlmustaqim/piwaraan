@extends('layout.app')

@section('content')
    <style>
        .h-100vh {
            height: 50vh;
            /* Mengisi 100% dari viewport height */
        }
    </style>
    <h2>{{ $data['title'] }}</h2>
    <div class="row">

        <div class="col-8">
            <div class="card">
                <img src="{{ asset('src/images/index_piwaraan.png') }}" class="">


            </div>


        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-inner">
                    <div class="team">

                        <div class="user-card user-card-s2">
                            <img src="{{ asset('src/images/bartim.png') }}" height="100px">
                            <div class="user-info">
                                <h6>{{ session('name') }}</h6>
                                <span class="sub-text">{{ $user->stakeholder}}</span>
                            </div>
                        </div>
                        <ul class="team-info">
                            <li><span>Email</span><span>{{ session('email') }}</span></li>

                        </ul>

                    </div><!-- .team -->
                </div><!-- .card-inner -->
            </div>

        </div>

    </div>
@endsection
@push('scripts')
  
@endpush
