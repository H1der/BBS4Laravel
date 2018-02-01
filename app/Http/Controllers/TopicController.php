<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        //带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);

        //专题的文章列表
        $posts = $topic->posts()->orderBy('created_at', 'desc')->take(10)->get();

        //属于我的文章,但是未投稿
        $myposts = Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic.show', compact('$topic', '$posts', '$myposts'));
    }

    public function submit(Topic $topic)
    {

    }
}
