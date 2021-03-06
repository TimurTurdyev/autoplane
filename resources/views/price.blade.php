@extends('layouts.app')

@push('meta_title', $page->meta_title)
@push('meta_description', $page->meta_description)

@section('content')
    <section class="content-top"
             style="--bg-image: url({{ $page->hero ?? 'https://auto-plane.ru/image/catalog/home/banner_1.jpg' }});">
        <div class="container padding-top pb-5 text-white">
            @if( $page->name ||  $page->setting)
                <div class="m-5 p-1 bg-black-opacity">
                    <h1 class="text-center mt-2 mb-3">{{ $page->heading ?? $page->name }}</h1>
                    @includeIf('partials.table-' . $page->slug, ['setting' => $page->setting])

                    @foreach( $prices as $price )
                        <h2 class="text-center mt-2 mb-3">{{ $price->heading ?? $price->name }}</h2>
                        @includeIf('partials.table-' . $price->slug, ['setting' => $price->setting])
                    @endforeach
                </div>
            @endif
            @if( $page->body )
                <div class="bg-orange p-3">{!! $page->body !!}</div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
{{--    <script type="text/javascript" src="{{ asset('/dist/hideseek/jquery.hideseek.min.js') }}"></script>--}}
{{--    <script>--}}
{{--        $('#search').hideseek({--}}
{{--            list: '.hideseek-data',--}}
{{--            nodata: '',--}}
{{--            attribute: 'text',--}}
{{--            matches: false,--}}
{{--            highlight: true,--}}
{{--            ignore: '',--}}
{{--            navigation: false,--}}
{{--            ignore_accents: false,--}}
{{--            hidden_mode: false,--}}
{{--            min_chars: 1--}}
{{--        });--}}
{{--    </script>--}}
@endpush

