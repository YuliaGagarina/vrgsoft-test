<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

/**
 * Class Book
 * @package App\Models
 *
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $author
 * @property int $author_id
 * @property string $publication
 *
 * */

class Book extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'author',
        'author_id',
        'publication'
    ];

    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}
