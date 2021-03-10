<!-- resources/views/posts.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->

    <!-- 全ての投稿リスト -->
    @if (count($posts) > 0)
                        <p class="border-bottom h3">　　　　　　　記事一覧</p>
                        @foreach ($posts as $post)
                        <!-- 3列表示 -->
                        @if ($loop->index % 3 == 0)
                          <div class="container">
                            <div class="row">
                        @endif
                              <div class="card">
                                <a class="link_hidden" href="{{ url('post/'.$post->id) }}">
                                  <img class="img_size" src="{{ Storage::url($post->file_path) }}" alt="カード画像">
                                  <div class="card-body">
                                    <h3 class="card-title">{{ $post->post_title }}</h3>
                                    <p class="card-text">{{ $post->post_desc }}</p>
                                  </div>
                                </a>
                              </div>
                        @if ($loop->iteration % 3 == 0)
                            </div>
                          </div>
                        @endif
                        @endforeach
    @endif
@endsection