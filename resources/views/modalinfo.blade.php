        <div class="container col-md-12 imginfo">
        <button class="close" id="closebtn{{ $product->id }}" type="button">×</button>
        <div class="row">
            <div class="col-md-4">
            <img src="{{ asset('http://dayfun.ru/wp-content/uploads/2012/08/%D1%87%D0%B5%D0%B1%D1%83%D1%80%D0%B0%D1%88%D0%BA%D0%B0.jpg') }}" alt="product" class="img-responsive">
            </div>

            <div class="col-md-8">
                <h3>${{ $product->price }}</h3>
                {{ $product->description }}<p>
                Уровень обработки: {{ $product->level }}
            </div>
        </div>
        </div>