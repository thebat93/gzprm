@extends('layouts.app')
@section('content')

    <div class="container">
        <p><a href="{{ url('/shop') }}">Shop</a> / {{ $product->slug }}</p>
        <h1>{{ $product->imgname }}</h1>

        <hr>

        <div class="row">
            <div class="col-md-4">
            <img src="{{ asset('http://dayfun.ru/wp-content/uploads/2012/08/%D1%87%D0%B5%D0%B1%D1%83%D1%80%D0%B0%D1%88%D0%BA%D0%B0.jpg') }}" alt="product" class="img-responsive">
                <!-- <img src="{{ asset('geoportal/Archive/testimages/' . $product->image) }}" alt="product" class="img-responsive"> -->
            </div>

            <div class="col-md-8">
                <h3>${{ $product->price }}</h3>
                <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->imgname }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
                </form>


                <br><br>

                {{ $product->description }}
            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->

    </div> <!-- end container -->

@endsection

