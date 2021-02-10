<?php

/**
 * @varIlluminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts
 */
 $title = '投稿一覧';
 ?>

@extends('front.layout.base')

@section('content')
<div class="card-header">{{ $title }}</div>
<div class="card-body">
    @if ($posts->count() <= 0)
        <p>表示する投稿はありません</p>
    @else
        <table class="table">
            @foreach ($posts as $post)
                <tr>
                  {{-- modelで取得した年月日を表示 --}}
                  <td>{{ $post->published_format }}</td>
                  {{-- link_to_route(リンク先,リンクのアンカーテキスト,リンク先に渡したい変数(配列も可)) --}}
                  <td>{!! link_to_route('front.posts.show', $post->title, $post) !!}</td>
                </tr>              
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
          {{-- app/Providers/AppServiceProvider.php でTailwindcssではないくてBootstrapを使うように設定する --}}
            {{ $posts->links() }}
        </div>
    @endif
</div>
    
@endsection