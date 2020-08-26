<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

// Модель статусов 
class Status extends Model
{
    protected $table = 'status';
    protected $fillable = ['id', 'title', 'alias', 'dashboard'];

    // Связь с продуктами
    public function products(){ 
        return $this->hasMany('Corp\Product', 'status_id');
    }
}
