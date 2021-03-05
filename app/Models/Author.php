<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Authors
 * @package App\Models
 *
 * @property string $fname
 * @property string $lname
 * @property string $fathername
 *
 * */

class Author extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'fathername'
    ];

    public function books() {
        return $this->belongsToMany(Book::class);
    }
}
