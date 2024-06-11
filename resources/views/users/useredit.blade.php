@extends('layouts.app')

@section('content')
    @if (Auth::user() == $user)
        <div class="prose ml-4">
            <h2 class="text-lg">id: {{ Auth::user()->id }} のユーザー情報編集ページ</h2>
        </div>
    
        <div class="justify-center">
            <form method="post" action="{{ route('image.store') }}" enctype="multipart/form-data" >
                @csrf
                
                <div class="form-control my-4">
                    <input type="file" name="image" accept="image/png, image/jpeg">
                </div> 
                <button type="submit" class="btn btn-primary normal-case">変更</button>
             </form>
            
            
            <form method="POST" action="{{ route('users.update', $user) }}" class="w-1/2">
                @csrf
                @method('PUT')
                    <div class="form-control my-4">
                        <label for="name" class="label">
                            <span class="label-text">名前:</span>
                        </label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="input input-bordered w-full">
                    </div>
            
                    <div class="form-control my-4">
                        <label for="email" class="label">
                            <span class="label-text">メールアドレス:</span>
                        </label>
                        <input type="text" name="email" value="{{ Auth::user()->email }}" class="input input-bordered w-full">
                    </div>
    
                    <div class="form-control my-4">
                        <label for="password" class="label">
                            <span class="label-text">パスワード:</span>
                        </label>
                        {{-- <input type="text" name="password" value="{{ Auth::user()->password }}" class="input input-bordered w-full"> --}}
                        <input type="text" name="password" value="" class="input input-bordered w-full">
                    </div>
                {{-- <button type="submit" class="btn btn-primary btn-outline">変更</button>  btn btn-error btn-sm normal-case--}}
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