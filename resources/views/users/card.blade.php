<div class="card border border-base-300　w-50">
    <figure>
        <div class="w-50 rounded">
            {{-- 
            ユーザーのメールアドレスをもとにGravatarを取得して表示 
            <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
            --}}
            @if ($user->image != NULL)
                <img src = "{{ Storage::url($user->image) }}">
            @else 
                <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
            @endif
        </div>
    </figure>
    <div class="card-body bg-base-200 text-4xl">
        <h2 class="card-title">{{ $user->name }}</h2>
    </div>

    {{-- フォロー／アンフォローボタン --}}
    @include('user_follow.follow_button')
    {{-- ユーザー情報変更ボタン --}}
    @include('users.idedit')
</div>

