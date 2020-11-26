<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = ['book_name', 'description', 'image', 'author_id'];

    /**
     * @return HasMany
     */
    public function authors()
    {
        return $this->hasMany(Author::class, 'author_id', 'id');
    }
}
