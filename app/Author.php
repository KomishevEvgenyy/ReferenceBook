<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    protected $fillable = ['author_surname', 'author_name', 'author_patronymic'];

    /**
     * @return BelongsTo
     */
    public function books()
    {
        return $this->belongsTo(Book::class, 'id', 'author_id');
    }
}
