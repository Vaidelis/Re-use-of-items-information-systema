@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="w-full px-5 py-4 mb-5 bg-green-100 border-l-4 border-green-500">
                            {{ $message }}
                        </div>
                    @endif

                    <div class="grid grid-cols-12 gap-x-4">
                        <div class="col-span-9">
                            <table class="content-table">
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
                </div>
            </div>
        </div>

@endsection
