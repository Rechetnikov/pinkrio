<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    protected $table = 'filials';
    protected $fillable = ['id', 'title', 'alias'];

    public function products(){
        return $this->hasMany('Corp\Product', 'filials_id');
    }
}
