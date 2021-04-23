<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
    ];
    // protected $casts = [
    //     'categories' => 'array',
    // ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public static function getPostUserModel($id)
    {
        $post = Post::orderBy('created_at', 'desc')->where('user_id', $id)->paginate(10);
        return $post;
    }
    public static function getAllPostModel()
    {
        $post = Post::orderBy('created_at', 'desc')->paginate(10);
        return $post;
    }
    public static function getPostIdModel($id)
    {
        $post = Post::where('id', $id)->first();
        return $post;
    }
    public static function getPostCategories()
    {
        $categories = Categories::orderBy('created_at', 'desc')->get();
        return $categories;
    }

}
