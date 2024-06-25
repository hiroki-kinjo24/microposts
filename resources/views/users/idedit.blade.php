@if (Auth::id() == $user->id)
    <div class="bg-red-500">
        {{-- ID変更のフォーム --}}
        <form method="POST" action="{{ route('users.edit', $user) }}">
            @csrf
            {{--<li><a class="link link-hover" href="{{ route('users.favoritings', Auth::user()->id) }}">favorite</a></li> --}}
            <button type="submit" class="btn btn-ghost btn-block normal-case">ユーザー情報を編集</button>
        </form>
    </div>
@endif