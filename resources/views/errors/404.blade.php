@extends('layouts.web')

@section('title', 'Woops! 404 Not Found')
@section('description', '')
@section('canonical', config('app.url') . Request::path() )

@section('content')

    <section class="container mx-auto my-10 px-4">

        {{-- <h1 class="text-primary text-4xl my-4"><strong>About</strong></h1> --}}

        <img class="mx-auto h-40 md:h-96" src="{{ asset('imgs/error/404.png') }}" alt="Not Found">

        <div class="text-center mt-3 space-y-2 text-xl md:text-3xl">
            <a href="{{route('home')}}" class="btn px-6 max-w-xs md:w-auto">
                Back to Home
            </a>
        </div>
    </section>

@endsection
