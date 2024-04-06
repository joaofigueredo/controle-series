<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover'];

    public function seasons()
    {
        //relacionamento um para muitos. uma serie tem varias temporadas
        //segundo parametro foreign key
        //terceiro parametro chave primaria
        return $this->hasMany(Season::class, 'series_id');
    }

    protected static function booted()
    {
        //adicionar escopo para criar regras que a lista final vai fazer
        self::addGlobalScope('ordered', function(Builder $queryBuilder){
            $queryBuilder->orderBy('nome');
        });
    }
}
