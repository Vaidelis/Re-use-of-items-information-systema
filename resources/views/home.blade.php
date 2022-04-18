@extends('layouts.app')

@section('content')

<body>
<div style="text-align: center;">
<p>Naudotojo vardas: <strong>{{ $userInfo->name }}</strong></p>
<p>El. paštas: <strong>{{ $userInfo->email }}</strong></p>
</div>


<div style="text-align: center;" class="">
    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="/"><button class="btn btn-primary darkGreen" style="cursor: pointer;">Atgal</button></a>
</div>
@if($userInfo->google_id == null)
<div style="text-align: center;" class="">
    <div class="row justify-content-center">
        <div class="">
            <div style="width: 100%;" class="">
                @csrf
                <div class="">
                    <h1>Slaptažodžio keitimas</h1>
                </div>
                <form method="POST" action="{{ route('UpdatePassword') }}">
                    @csrf
                    <div class="">
                        <label for="password" class="">{{ __('Slaptažodis') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Naujas slaptažodis">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <br>
                    <div class="">
                        <label for="password-confirm" class="">{{ __('Pakartokite slaptažodį') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Pakartotas naujas slaptažodis">
                    </div>
                    @if($status != null)
                        <h3 style="color: red; margin-bottom: 0px;">  {{ $status }}</h3>
                        @elseif($status2 != null)
                        <h3 style="color: green; margin-bottom: 0px;">  {{ $status2 }}</h3>
                @endif
            </div>
            <br>
            <button id="Save" type="submit" class="btn btn-primary darkGreen">Saugoti</button>
        </div>
        </form>
    </div>
</div>
@endif
</div>
</div>
</body>
</html>

@endsection
