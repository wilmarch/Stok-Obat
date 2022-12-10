<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory,SoftDeletes,Notifiable;

    protected $fillable = [
        'purchase_id', 'price',
        'discount', 'description',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
