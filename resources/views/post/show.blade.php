@extends('layout.master')

@section('content')
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$post['title']}}</h2>
                @can('update',$post)
                    <a style="margin: auto" href="/posts/{{$post['id']}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                @endcan
                @can('delete',$post)
                    {{--<form method="post" action="/posts/{{$post['id']}}" accept-charset="utf-8" id="hidden-delete-form">--}}
                    {{--<input name="_method" type="hidden" value="delete">--}}
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    {{--<button type="submit" class="btn btn-info btn-danger btn-sm iframe cboxElement">--}}
                    {{--<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>--}}
                    {{--</form>--}}

                    <a href="#" style="margin: auto" class="glyphicon glyphicon-remove"
                       onclick="del({{$post['id']}})">
                        {{--<span class="glyphicon glyphicon-remove"  delete-url="/posts/{{$post['id']}}" aria-hidden="true"></span>--}}
                    </a>
                @endcan
            </div>

            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by <a
                        href="#">{{$post->user->name}}</a></p>

            <p>
            <p>{!!$post['content']!!}
            <div>
                @if($post->zan(Auth::id())->exists())
                    <a href="/posts/{{$post->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                @else
                    <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                @endif
            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{$comment->created_at}} by {{$comment->user->name}}</h5>
                        <div>
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="/posts/{{$post->id}}/comment" method="post">
                    {{csrf_field()}}
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        @include('layout.error')
                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->

@endsection