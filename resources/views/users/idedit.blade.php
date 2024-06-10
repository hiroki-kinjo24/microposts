@if (Auth::id() == $user->id)
    {{-- ID変更のフォーム --}}
    <form method="POST" action="{{ route('users.edit', $user) }}">
        @csrf
        {{--<li><a class="link link-hover" href="{{ route('users.favoritings', Auth::user()->id) }}">favorite</a></li> --}}
        <button type="submit" class="btn btn-error btn-block normal-case">userデータの変更</button>
    </form>
@endif