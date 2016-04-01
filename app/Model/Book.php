<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function issue()
    {
        return $this->belongsToMany('Model\BookIssue', 'BookID' ,'id');
    }
}
