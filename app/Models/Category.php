<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Definisikan kolom yang dapat diisi
    protected $fillable = ['name'];

    // Relasi ke model Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}