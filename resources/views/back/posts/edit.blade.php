<?php
$title = '投稿編集';
?>
@extends('back.layout.base')

@section('content')
<div class="card-header">投稿編集</div>
<div class="card-body">
  {{-- 元データがあるのでForm::modelを使う --}}
    {!! Form::model($post, [
        'route' => ['back.posts.update', $post],
        'method' => 'put'
    ]) !!}
    @include('back.posts._form')
    {!! Form::close() !!}
    <table class="table">
      <tr>
        <th>編集者</th>
        <td>{{ $post->user->name }}</td>
      </tr>
      <tr>
        <th>登録日時</th>
        <td>{{ $post->created_at }}</td>
      </tr>
      <tr>
        <th>編集日時</th>
        <td>{{ $post->updated_at }}</td>
      </tr>
    </table>
</div>
@endsection