<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $table = 'director';
    protected $fillable = ['name', 'tmdb_id', 'biography', 'date_of_birth'];
    public $timestamps = null;

    protected $primaryKey = 'tmdb_id';
}
