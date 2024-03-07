<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public function series()
    {
        //relaçao de um para um. Uma temporada pertence a uma serie.
        return $this->belongsTo(Season::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

}
