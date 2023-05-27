<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    /**
     * Primary Key
     */
    public function categories(){
        return $this->belongsToMany(Categories::class, 'category_relationships', 'post_id', 'category_id');
    }
}

