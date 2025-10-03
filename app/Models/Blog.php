<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    //
    protected $fillable = [
        'title',
        'content',
    ];

    /*
     * get the user that owns the blog
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User>
     * */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
