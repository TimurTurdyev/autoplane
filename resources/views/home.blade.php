@extends('layouts.app')

@push('meta_title', $page->meta_title)
@push('meta_description', $page->meta_description)

@section('content')
    <section class="content-top"
             style="--bg-image: url({{ $page->hero ?? 'https://auto-plane.ru/image/catalog/home/banner_1.jpg' }});">
        <div class="container padding-top pb-5 text-white">
            <div id="owl1" class="owl-carousel owl-theme w-75 m-auto mb-5">
                @foreach( $promotions as $promo )
                    <div class="card bg-orange border-warning border-5">
                        <div class="bg-black-opacity h3 text-center p-2">{{ $promo->name }}</div>
                        <div class="card-body">
                            <img src="{{ $promo->photo }}" alt="{{ $promo->name }}" class="rounded img-fluid">
                            <p class="card-text">{{ $promo->description_short }}</p>
                            <a href="{{ route('page', 'promotion') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-black-opacity p-5">
                <div class="owl-carousel owl-theme" id="owl2">
                    @foreach( $galleries as $gallery )
                        @foreach( $gallery->attachment as $attach )
                            <div class="card-photo" style="--bg-image: url({{ $attach->relativeUrl }});"></div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container padding-top pb-5">
            @if( $page->name)
                <div class="m-5 p-1">
                    <h1 class="text-center mt-2 mb-3">{{ $page->heading ?? $page->name }}</h1>
                </div>
            @endif

            @if( $page->body )
                <div class="p-3">{!! $page->body !!}</div>
            @endif
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{  asset('/dist/owl-carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('/dist/owl-carousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('/css/owl-fix.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('/dist/owl-carousel/owl.carousel.min.js') }}"></script>
    <script>
        $('#owl1').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        $('#owl2').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 5
                }
            }
        });
    </script>
@endpush
