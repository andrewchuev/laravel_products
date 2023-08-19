<?php

namespace App\Models;

use App\Events\ProductUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'updated' => ProductUpdated::class,
        'created' => ProductUpdated::class,
    ];
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}
