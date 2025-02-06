<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Definisikan kolom yang dapat diisi
    protected $fillable = ['title', 'body', 'image', 'category_id'];

    // Relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}