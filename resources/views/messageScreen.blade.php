@extends('layouts.app')
@section('content')
    <div class="container">
    <div style="text-align: center" class="">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
           Tema: {{ $thread->subject }}
        </h2>
        <hr>
        <a href="{{ url('messageList') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
    </div>
    <hr>


        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-md-6">
                        <div class="space-y-4">
                            @foreach ($thread->messages as $message)
                                <div class="px-4 py-2 leading-relaxed border rounded-lg sm:px-6 sm:py-4">
                                    <a href="{{route('portfolioshow', $message->user->id)}}"><strong>{{ $message->user->name }}</strong></a>
                                    <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}
                                    </span>
                                    <p class="text-sm">
                                        {{ $message->body }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('updatemessage', $thread) }}" method="post">
                        @csrf
                        @method('PUT')

                        <!-- Message Form Input -->
                            <div class="mt-4">
                                <x-label for="message" :value="__('Atsakymas')" />
                                <br>
                                <textarea required name="message" style="width: 600px;height: 100px"
                                          class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('message') }}</textarea>
                            </div>

                            <!-- Submit Form Input -->
                            <div class="mt-4">
                                <x-button class="btn btn-primary">Išsiųsti</x-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
