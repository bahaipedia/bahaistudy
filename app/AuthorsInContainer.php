<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorsInContainer extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
