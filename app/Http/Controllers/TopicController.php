<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTopic;
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

        //属于我的未投稿文章
        $myposts = Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic.show', compact('topic', 'posts', 'myposts'));
    }

    public function submit(Topic $topic)
    {
        $this->validate(\request(), [
            'post_ids' => 'required|array',
        ]);

        $post_ids = \request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id) {
            PostTopic::firstOrCreate(compact('topic_id', 'post_id'));
        }

        return back();

    }
}
