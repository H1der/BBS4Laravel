<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    /**
     * 文章列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(5);
        return view('post/index', compact('posts'));
    }


    /**
     * 写文章
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('post/create');
    }


    /**
     * 文章创建
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //验证
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);


        $user_id = \Auth::id();
        $params = array_merge($request->all(), compact('user_id'));
        $post = Post::create($params);
        return redirect('/posts');
    }


    /**
     * 文章详情
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        $post->load('comments');
        return view('post/show', compact('post'));
    }


    /**
     * 文章编辑
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }


    /**
     * 文章编辑更新
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        //验证
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        $this->authorize('update', $post);

        $post['title'] = $request['title'];
        $post['content'] = $request['content'];
        $post->save();
        return redirect("/posts/{$post->id}");
    }


    /**
     * 文章删除
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id, Post $post)
    {
        $this->authorize('update', $post);
        Post::destroy($id);

        return redirect('/posts');
    }

    /**
     * 图片上传
     * @param Request $request
     * @return string
     */
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);

    }

    /**
     * 文章评论
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Post $post)
    {
        $this->validate(\request(), [
            'content' => 'required|min:3',
        ]);

        $comments = new Comment();
        $comments->user_id = \Auth::id();
        $comments->content = \request('content');
        $post->comments()->save($comments);

        return back();
    }

    /**
     * 文章点赞
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function zan(Post $post)
    {
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($param);
        return back();
    }


    /**
     * 取消点赞
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    public function search()
    {
        $this->validate(\request(), [
            'query' => 'required'
        ]);

        $query = \request('query');
        $posts = Post::search($query)->paginate(2);

        return view('post/search', compact('posts', 'query'));
    }
}
