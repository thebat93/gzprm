<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
protected $table = 'orders';
//protected $timestamps = true;
protected $fillable = array('link','state','user_id','area','geometry','satellite','angle_sun','angle_nadir','cloud','priority','id_snapshot','start_time','end_time','price','level');

public function user(){
return $this->belongsTo('App\User','user_id');
}
}
