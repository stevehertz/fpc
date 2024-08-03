<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait HasUuid
{
     /**
     * The attributes that should be UUID.
     *
     * @var array<string, string>
     */
    protected static function bootHasUuid()
    {
        static::creating(function($model){
            if(empty($model->uuid)){
                $model->uuid = Uuid::uuid4()->toString();
            }
        });
    }
}