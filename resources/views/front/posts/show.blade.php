<?php
/**
 * @var \App\Model\Post $post
 */ 
$title = '投稿詳細'
?>
@extends('ftont.layout.base')

@section('content')
<div class="card-header">{{ $title }}</div>
<div class="card-body">
    <h2>{{ $post->title }}</h2>
    {{-- modelで取得した年月日を表示 --}}
    <time>{{ $post->published_format }}</time>
    <div>{{!! nl2br(e($post->body)) !!}}</div>
    {{!! link_to_route(
        'front.post.index', '一覧に戻る', null,
        ['class' => 'btn btn-secondary'])
    !!}}
</div>
@endsection