<?php
/**
 * @var A\Models\Tag $tag
 */
$title = 'タグ登録';
?>
@extends('back.layout.base')

@section('content')
<div class="card-header">{{ $title }}</div>
<div class="card-body">
    {{ Form::open(['route' => 'back.tags.store'])}}
    @include('back.tags._form')
    {{ Form::close() }}
</div>
@endsection