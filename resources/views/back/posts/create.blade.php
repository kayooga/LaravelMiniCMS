<?php
$title = '投稿登録';
?>
@extends('back.layout.base')
 
@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {{ Form::open(['route' => 'back.posts.store']) }}
        @include('back.posts._form')
        {{ Form::close() }}
    </div>
@endsection