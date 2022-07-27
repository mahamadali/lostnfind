@extends('frontend/app')

@block("title") {{ $cmsPage->title_beautify. ' - '.setting('app.title') }} @endblock

@block("styles")
<style>
    .main-section {
        margin-top: 50px;
    }
</style>
@endblock

@block("hero")
@endblock

@block("content")

<section id="{{ $cmsPage->title }}" class="main-section">
    <div class="container" data-aos="fade-up">

    <div class="section-header">
    <span>{{ $cmsPage->title_beautify }}</span>
    <h2>{{ $cmsPage->title_beautify }}</h2>

    </div>

    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
            {{ $cmsPage->description }}
        </div>
    </div>
    </div>
</section>

@endblock

@block("scripts")
@endblock