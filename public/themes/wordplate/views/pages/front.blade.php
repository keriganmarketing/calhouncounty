@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        <kma-slider class="slider-container"></kma-slider>
        
        <div class="welcome position-absolute">
            <div class="text-center">
            <p class="biggest text-white">WELCOME</p>
            {{ get_search_form() }}
            </div>
        </div>
        @include('partials.buttongallery')
        <main id="content" role="main" class="sizable">
            <div class="container">

                <div class="row py-4 align-items-center">
                    <div class="col-lg-6 py-4">
                        <article class="front" tabindex="0">
                            
                            {{ the_content() }}

                        </article>
                    </div>
                    <div class="col-lg-6 py-4" tabindex="0">
                        <div class="embed-responsive embed-responsive-16by9">
                        {!! $video !!}
                        <button v-if="!videoPlaying" class="video-button" aria-hidden="true" @click="playVideo" ref="videobutton"></button>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    @endwhile
@else
    @include('pages.404')
@endif
@endsection