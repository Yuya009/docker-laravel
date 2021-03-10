@extends('layouts.app')
@section('content')

  <img class="img_size" src="{{ Storage::url($post->file_path) }}" alt="カード画像">
  <h3 class="card-title">{{ $post->post_title }}</h3>
  <p class="card-text">{{ $post->post_desc }}</p>

  <a href="{{ url('/top') }}">トップに戻る</a>
@endsection