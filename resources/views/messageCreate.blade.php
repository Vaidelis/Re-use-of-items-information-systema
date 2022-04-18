@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create new message') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('storemessage') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <!-- Subject Form Input -->
                            <div>
                                <x-label for="subject" :value="__('Tema')" />
                                <br>
                                <x-input required id="subject" class="block w-full mt-1" type="text" name="subject"
                                         :value="old('subject')" />
                            </div>

                            <!-- Recipients list -->
                            <div class="mt-4">
                                <x-label hidden for="recipient" :value="__('Recipient')" />
                                <select hidden name="recipient"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                                        <option value="{{ $users->id }}">{{ $users->name }}</option>

                                </select>
                                    <p>Skelbimo savininkas  - <b>{{$users->name}}</b></p>
                            </div>

                            <!-- Message Form Input -->
                            <div class="mt-4">
                                <x-label for="message" :value="__('Žinutė')"/>
                                <br>
                                <textarea required name="message" style="width: 600px;height: 100px"
                                          class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('message') }}</textarea>
                            </div>

                            <!-- Submit Form Input -->
                            <div class="mt-4">
                                <x-button class="btn3 btn-primary">Išsiųsti</x-button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
