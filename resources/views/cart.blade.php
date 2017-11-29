@extends('layouts.app')
@section('content')

    <div class="container"style="padding-top: 60px;">
        <h1>{{ trans('geoportal.ycart') }}</h1>

        <hr>

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

        @if (sizeof(Cart::content()) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <!--<th class="table-image"></th>-->
                        <th>{{ trans('geoportal.product') }}</th>
                        <th>{{ trans('geoportal.level') }}</th>
                        <th>{{ trans('geoportal.price') }}</th>
                        <th class="column-spacer"></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::content() as $item)
                    <tr>
                        <!--<td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image"></a></td>-->
                        <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                        <td>
                            <select class="level" data-id="{{ $item->rowId }}">
                                <option {{ $item->options->level == 'L0' ? 'selected' : '' }}>L0</option>
                                <option {{ $item->options->level == 'L1A' ? 'selected' : '' }}>L1A</option>
                                <option {{ $item->options->level == 'L1B' ? 'selected' : '' }}>L1B</option>
                            </select>
                        </td>
                        <td>${{ $item->subtotal }}</td>
                        <td class=""></td>
                        <td>
                            <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm" value="{{ trans('geoportal.remove') }}">
                            </form>
                        </td>
                    </tr>

                    @endforeach
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">{{ trans('geoportal.subtotal') }}</td>
                        <td>${{ Cart::instance('default')->subtotal() }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">{{ trans('geoportal.tax') }}</td>
                        <td>${{ Cart::instance('default')->tax() }}</td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr class="border-bottom">
                        <td class="table-image"></td>
                        <td style="padding: 40px;"></td>
                        <td class="small-caps table-bg" style="text-align: right">{{ trans('geoportal.total') }}</td>
                        <td class="table-bg">${{ Cart::total() }}</td>
                        <td class="column-spacer"></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>

            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">{{ trans('geoportal.contshop') }}</a> &nbsp;
            <a href="{{ url('/checkout') }}" class="btn btn-success btn-lg">{{ trans('geoportal.checkout') }}</a>

            <div style="float:right">
                <form action="{{ url('/emptyCart') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger btn-lg" value="{{ trans('geoportal.emptycart') }}">
                </form>
            </div>

        @else

            <h3>{{ trans('geoportal.noitems') }}</h3>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">{{ trans('geoportal.contshop') }}</a>

        @endif

        <div class="spacer"></div>

    </div> <!-- end container -->


    <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.level').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '{{ url("/cart") }}' + '/' + id,
                  data: {
                    'level': this.value,
                  },
                  success: function(data) {
                    //window.location.href = '{{ url('/cart') }}';
                  }
                });

            });
        
    </script>
@endsection

