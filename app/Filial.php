<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

// Модель филиалов 
class Filial extends Model
{
    protected $table = 'filials';
    protected $fillable = ['id', 'title', 'alias'];

    public function products(){ // Связь с продуктами
        return $this->hasMany('Corp\Product', 'filials_id');
    }
}
