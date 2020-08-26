<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = ['id', 'title', 'alias', 'dashboard'];

    public function products(){
        return $this->hasMany('Corp\Product', 'status_id');
    }
}
