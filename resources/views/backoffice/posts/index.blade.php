@extends('layouts.backoffice')

@section('title', trans('backoffice.posts'))

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h1>{{ trans('backoffice.posts') }}</h1>
            <p>
                {{ trans('backoffice.page.posts.about') }}
            </p>
            <hr/>
            @if(count($posts) == 0)
                <div class="alert alert-info" role="alert">
                    {{ trans('backoffice.warnings.no_posts') }}
                </div>
            @endif
            @if(Session::has('info'))
                <div class="alert alert-info" role="alert">
                    {{ Session::get('info') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{ trans('setup.generic.oops') }}</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <a class="btn btn-primary btn-lg" href="{{ URL::route('admin::createPost') }}">{{ trans('backoffice.create_post') }}</a>
            <hr/>
            @foreach ($posts as $post)
                <div class="panel panel-default post-brief">
                    <div class="panel-body support-panel">
                            <a href="{{ URL::route('admin::editPost', $post->id) }}" class="btn btn-default btn-sm pull-right">
                                {{ trans('backoffice.edit') }}
                            </a>
                        <h2>{{ $post->title }}</h2>
                        <div class="description">
                            {!! Markdown::convertToHtml($post->content) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection