<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use SoftDeletes;
    protected $fillable = ['customer_name', 'phone', 'address'] ;
}
