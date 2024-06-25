@extends('layouts.app')

@section('content')
    <div class="mt-4 flex">
        <form method="post" action="{{ route('users.search') }}"enctype="multipart/form-data">
            @csrf
            <div class="form-control mt-4 w-100">
                <textarea type="text" name="word" class="input input-bordered w-full"></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case mb-4">検索</button></button>
        </form>
    </div>
    {{-- ユーザー一覧 --}}
    @include('users.users')
@endsection