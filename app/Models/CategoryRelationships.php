<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CategoryRelationships extends Model
{

    protected $table = 'category_relationships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'category_id'
    ];


    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
