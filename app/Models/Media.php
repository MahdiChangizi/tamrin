<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    
    protected $table = 'medias';
    protected $fillable = [
        'title',
        'image',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}