<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    public function user() {
        return $this->belongsTo("App\User");
    }

    public function category() {
        return $this->belongsTo("App\Category");
    }

    public function tags() {
        return $this->belongsToMany("App\Tag");
    }
}
