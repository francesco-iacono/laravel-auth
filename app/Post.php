<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'subtitle',
        'text',
        'img_path',
        'publication_date',
        'slug'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
