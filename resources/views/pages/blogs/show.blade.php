@extends('layouts.web')

@section('title', $blog->title ?? "-")
@section('description', $blog->meta_description  ?? "-")
@section('canonical', $blog->canonical  ?? "-")

@section('hero-section')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col items-center md:items-start space-y-2 md:space-y-0 md:flex-row md:justify-between">
            <h4 class="text-white text-3xl italic"> {{ $blog->title }} </h4>

            @include('partials.frontend.breadcrumb')
        </div>
    </div>
@endsection
@section('content')

    <main class="container mx-auto px-4 md:px-14 lg:px-18 xl:px-28 my-10 font-montserrat">

        <div class="flex justify-between">
            <div class="text-[#626262]">
                Published by  <i class="fa fa-user px-1"></i> {{ $blog->user->name }} on <i class="fa fa-clock-o px-1"></i> {{ showDate($blog->created_at) }}
            </div>
            <div>
                <div @click.away="open = false" x-data="{ open: false }" class="group inline-block relative">
                    <button @click="open = !open"
                        class=" inline-flex text-[#bcbcbd] py-2 md:mx-2 xl:px-1 text-base hover:text-primary-one items-center">
                        <span class="mr-1">Category</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 ml-1 transition-transform duration-200 transform rotate-0">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 mt-1 origin-top-right md:w-48 hidden bg-white p-3 text-[#333] group-hover:block z-20 w-48 space-y-2"
                        :class="{'hidden': !open}" style="display: none;">
                            <li class="cursor-pointer hover:text-primary-one">{{ $blog->category->name }}</li>
                    </ul>
                </div>
                <div @click.away="open = false" x-data="{ open: false }" class="group inline-block relative">
                    <button @click="open = !open"
                        class=" inline-flex text-[#bcbcbd] py-2 md:mx-2 xl:px-1 text-base hover:text-primary-one items-center">
                        <span class="mr-1">Tags</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 ml-1 transition-transform duration-200 transform rotate-0">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 mt-1 origin-top-right md:w-48 hidden bg-white p-3 text-[#333] group-hover:block z-20 w-48 space-y-2"
                        :class="{'hidden': !open}" style="display: none;">
                            @foreach ($blog->tags as $tag)
                                <li class="cursor-pointer hover:text-primary-one">{{ $tag->name }}</li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <img src="{{ url('storage/app/public/'.$blog->image_path) }}" alt="blog-image-{{ env('APP_NAME') }}" class="my-10 mx-auto border-8 border-gray-100 hover:opacity-70 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-10 cursor-pointer max-h-[30rem]"/>

        <section class="blog-section">
            {!! $blog->description !!}
        </section>

    </main>

@endsection
