@extends('layouts.app')

@section('content')
    @php
        $switch = 1
    @endphp
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            {{-- ユーザー情報 --}}
            @include('users.card')
            {{-- 投稿フォーム --}}
            @include('microposts.form')
        </aside>
        
        <div class="sm:col-span-2 mt-4">
            {{-- タブ --}}  
            @include('users.navtabs')
            {{-- 投稿一覧 --}}
            @include('microposts.microposts')
        </div>
    </div>
@endsection