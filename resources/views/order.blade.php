@extends('layouts.app')
@section('content')
<div class="container" style="padding-top: 60px;">
<div class="row">
        <div class="col-md-8">
            <h3>Номер заказа: {{$order->id}}</h3>
            <h3>Время заказа: {{$order->created_at}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th >ID</th>
                    <th >Файл</th>
                    <th >Состояние</th>
                    <th >Спутник</th>
                    <th >Угол Солнца</th>
                    <th >Угол съемки</th>
                    <th >Макс. облачность</th>
                    <th >Начало съемки</th>
                    <th >Конец съемки</th>
                    <th >Цена</th>
                    <th >Уровень обработки</th>
                </tr>
                </thead>
                
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->link}}</td>
                        <td>{{$order->state}}</td>
                        <td>{{$order->satellite}}</td>
                        <td>{{$order->angle_sun}}</td>
                        <td>{{$order->angle_nadir}}</td>
                        <td>{{$order->cloud}}</td>
                        <td>{{$order->start_time}}</td>
                        <td>{{$order->end_time}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->level}}</td>
                    </tr>
                
            </table>
        </div>
    </div>
</div>
@endsection
