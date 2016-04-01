<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    //
    public function book()
    {
        return $this->belongsTo('App\Model\Book', 'bookID' );
    }

    public function member()
    {
        return $this->belongsTo('App\Model\Member', 'memberID' );
    }
}
