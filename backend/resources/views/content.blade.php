@extends('layouts.app')
@section('content')
  <img class="img_size" src="{{ Storage::url($post->file_path) }}" alt="カード画像">
  <h3 class="card-title">{{ $post->post_title }}</h3>
  <p class="card-text">{{ $post->post_desc }}</p>

  <a href="{{ url('/top') }}">トップに戻る</a>
  @if(Auth::check())
    @if(Auth::id() != $post->user_id && $post->favo_user()->where('user_id',Auth::id())->exists() !== true)
      <form action="{{ url('post/'.$post->id) }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger">
          お気に入り
        </button>
      </form>
    @endif
  @endif
@endsection