<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comment;
class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable=['title','description','posted_by'];
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
