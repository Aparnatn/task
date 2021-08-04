<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    public function users()
    {
        return $this->belongsTo(Users::class);

    }
}
