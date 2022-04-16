@extends('layouts.app')

@push('meta_title', $page->meta_title)
@push('meta_description', $page->meta_description)

@section('content')
    <section class="content-top"
             style="--bg-image: url({{ $page->hero ?? 'https://auto-plane.ru/image/catalog/home/banner_1.jpg' }});">
        <div class="container padding-top pb-5 text-white">
            @if( $page->name)
                <div class="m-5 p-1 bg-black-opacity">
                    <h1 class="text-center mt-2 mb-3">{{ $page->heading ?? $page->name }}</h1>
                </div>
            @endif
            @if( $page->body )
                <div class="bg-orange p-3">{!! $page->body !!}</div>
            @endif
        </div>
    </section>
    <section>
        <div class="container pt-5 pb-5">
            @foreach( $galleries->items() as $gallery )
                <h2>{{ $gallery->name }}</h2>
                <div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>
                    @foreach( $gallery->attachment as $attachment )
                        <div class="card grid-item">
                            <img src="{{ $attachment->relativeUrl }}" data-fancybox="gallery"
                                 data-caption="{{ $attachment->alt }}" class="card-img-top"
                                 alt="{{ $attachment->alt }}">
                            @if( $attachment->alt || $attachment->description )
                                <div class="card-body">
                                    @if( $attachment->alt )
                                        <h5 class="card-title">{{ $attachment->alt }}</h5>
                                    @endif
                                    @if( $attachment->description )
                                        <p class="card-text">{{ $attachment->description }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
            {{ $galleries->links() }}
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/fancybox/fancybox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{  asset('/css/mansory.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('/dist/masonry/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('/dist/fancybox/fancybox.umd.js') }}"></script>
@endpush
