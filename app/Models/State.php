<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class State extends Model
{
    use HasFactory;

    const CREATED_ID = 1;
    const PUBLISHED_ID = 2;

    public function movie(): HasOne
    {
        return $this->hasOne(Movie::class, 'state_id', 'id');
    }
}
