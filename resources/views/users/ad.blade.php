@extends('layouts.app')

@section('content')
    @if (Auth::user() == $user)
        <div class="prose ml-4">
            <h2 class="text-lg">広告追加ページ</h2>
        </div>
    
        <div class="justify-center">
            <form method="post" action="{{ route('users.addad' ,$user) }}" enctype="multipart/form-data" >
                @csrf
                
                <div class="form-control my-4">
                    <input type="file" name="image" accept="image/png, image/jpeg">
                </div> 
                
            
                <div class="form-control my-4">
                    <label for="account" class="label">
                        <span class="label-text">アカウント名:</span>
                    </label>
                    <input type="text" name="account" value="" class="input input-bordered w-full">
                </div>
            
                <div class="form-control my-4">
                    <label for="content" class="label">
                        <span class="label-text">広告文:</span>
                    </label>
                    <input type="text" name="content" value="" class="input input-bordered w-full">
                </div>
                
                <button type="submit" class="btn btn-primary normal-case">変更</button>
            </form>
            
        </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>権限がありません</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="/">back top</a>
                </div>
            </div>
        </div>
    @endif

@endsection