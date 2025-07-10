<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['customer_name', 'phone', 'address'] ;

    // public function rule(){

    // }

    // public function messages(){
    //     return [
    //         'customer_name'
    //     ];
    // }
}
