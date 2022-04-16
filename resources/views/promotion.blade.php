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
            @foreach( $promotions as $promo )
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $promo->photo }}" class="img-fluid rounded-start" alt="{{ $promo->name }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $promo->name }}</h5>
                                {!! $promo->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $promotions->links() }}
        </div>
    </section>
@endsection
