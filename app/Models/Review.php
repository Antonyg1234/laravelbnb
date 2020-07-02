<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['id','content','rating'];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function boooking()
    {
        return $this->belongsTo(Booking::class);
    }
}
