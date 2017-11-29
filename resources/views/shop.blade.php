@extends('master')

@section('content')

    <div class="container">

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        @foreach ($products->chunk(4) as $items)
            <div class="row">
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                <!-- <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a> -->
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('http://dayfun.ru/wp-content/uploads/2012/08/%D1%87%D0%B5%D0%B1%D1%83%D1%80%D0%B0%D1%88%D0%BA%D0%B0.jpg') }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->imgname }}</h3>
                                <p>{{ $product->id }}</p>
                                <p>${{ $product->price }}</p>
                                </a>
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

    </div> <!-- end container -->

@endsection
