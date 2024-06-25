@if (isset($users))
    <ul class="list-none">
        @foreach ($users as $user)
            <li class="flex items-center gap-x-2 mb-4">
                {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
                <div class="avatar">
                    <div class="w-12 rounded">
                        @if ($user->image != NULL)
                            <img src = "{{ Storage::url($user->image) }}">
                        @else 
                            <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
                        @endif
                    </div>
                </div>
                <div>
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        {{-- ユーザー詳細ページへのリンク --}}
                        <p><a class="link link-hover text-info" href="{{ route('users.show', $user->id) }}">View profile</a></p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    
@endif