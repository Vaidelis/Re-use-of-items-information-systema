@extends('layouts.app')

@section('content')
    <body style="margin-top: 0px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti daikto skelbimą</div>
                    <div class="card-body">

                                <livewire:assignment />

                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>

    @yield('scripts')
    @livewireScripts
@endsection
