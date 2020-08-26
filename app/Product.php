<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

// Модель продуктов
class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id', 'title', 'text', 'prise', 'public', 'status_id', 'filials_id'];

    // Связь с филиалами
    public function filial()
    {
      return $this->belongsTo('Corp\Filial', 'filials_id');
    }

    // Связь со статусами
    public function status()
    {
      return $this->belongsTo('Corp\Status', 'status_id');
    }   
}
