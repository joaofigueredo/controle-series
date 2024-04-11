<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover'];
    protected $appends = ['links'];

    public function seasons()
    {
        //relacionamento um para muitos. uma serie tem varias temporadas
        //segundo parametro foreign key
        //terceiro parametro chave primaria
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    protected static function booted()
    {
        //adicionar escopo para criar regras que a lista final vai fazer
        self::addGlobalScope('ordered', function(Builder $queryBuilder){
            $queryBuilder->orderBy('nome');
        });
    }

    public function links() : Attribute
    {
        return new Attribute(
            get: fn () => [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/api/series/{$this->id}/episodes"
                ]
            ]
        );
    }
}
