<?php

namespace App;

use App\Model;

class Topic extends Model
{
    //属于这个专题的所有文章
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_topics', 'topic_id', 'post_id');
    }

    //专题的文章数
    public function postTopics()
    {
        return $this->hasMany(PostTopic::class, 'topic_id');
    }
}
