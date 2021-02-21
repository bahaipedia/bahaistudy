<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
     public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function host()
    {
        return $this->belongsTo(User::class);
    }
}
