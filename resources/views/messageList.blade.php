@extends('layouts.app')

@section('content')

    <div class="container">
        <div style="text-align: center" class="">
            <h4 class="">Jūsų žinučių sąrašas</h4>
            <hr>

            <a href="{{ url('/') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>
        </div>
        <hr>
                    @if ($message = Session::get('success'))
            <center>
                <div style="width: 70%;height: 50px;text-align: center;" class="alert alert-success">
                    <span style="text-align: center">{{ $message }}</span>
                </div>
            </center>
                    @endif
                @if($threads->count())
                    <div class="grid grid-cols-12 gap-x-4">
                        <div class="col-span-9">
                            <table style="margin-left: auto;margin-right: auto" class="content-table">
                                <thead class="border-b bg-gray-50">
                                <th
                                    class="px-5 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">
                                    Siuntėjas</th>
                                <th
                                    class="px-5 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">
                                    Tema</th>
                                <th
                                    class="px-5 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">
                                    Veiksmai
                                </th>
                                </thead>
                                <tbody>
                                @each('partials.thread', $threads, 'thread',
                                'partials.no-threads')
                                </tbody>
                            </table>
                        </div>
                    </div>
        @else
            @each('partials.thread', $threads, 'thread',
                        'partials.no-threads')
        @endif

                </div>

@endsection
