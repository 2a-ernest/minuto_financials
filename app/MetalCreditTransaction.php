<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetalCreditTransaction extends Model
{
    -------------------
/**
    * The "booting" method of the model.
    *
    * @return void
    */
   protected static function boot()
   {
       parent::boot();

       static::addGlobalScope('scope', function(Builder $builder) {
           $builder->where('param', '>', 'value');
       });
   }
-------------------
//
}
