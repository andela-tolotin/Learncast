<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id', 'video_id'];

    public function video()
    {
        return $this->belongsTo('App\Video');
    }

    public function scopeGetCommentsOnVideo($query)
    {
        $query->where('videos.id', '=', 'comments.video_id');
    }
}