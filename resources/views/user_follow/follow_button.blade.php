@if (Auth::id() != $user->id)
    @if (Auth::user()->is_following($user->id))
        {{-- アンフォローボタンのフォーム --}}
        <div class="bg-green-300">
            <form method="POST" action="{{ route('user.unfollow', $user->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-ghost btn-block normal-case" 
                    onclick="return confirm('id = {{ $user->id }} のフォローを外します。よろしいですか？')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    フォロー中
                </button>
            </form>
        </div>
    @else
        <div class="bg-gray-800 text-white">
            {{-- フォローボタンのフォーム --}}
            <form method="POST" action="{{ route('user.follow', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-ghost btn-block normal-case">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    フォローする
                </button>
            </form>
        </div>
    @endif
@endif