<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'commenter'   
    ];
    public function user()
    {
        return $this->belongsTo('app\models\user');
    }
    public function post()
    {
        return $this->belongsTo('app\models\Post');
    }
}
