<div class="mt-4">
    @if (isset($microposts))
        <ul class="list-none">
            @php 
                $key = 0 
            @endphp
            @foreach ($microposts as $micropost)
                @php $key = $key + 1 
                @endphp
                
                @if ($key % 5 == 0)
                    {{-- ここに広告を入れる--}}
                    <p>広告</p>
                    @php $key = 0 @endphp
                @endif
                
                <li class="flex items-start gap-x-2 mb-4">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            @if ($micropost->user->image != NULL)
                                <img src = "{{ Storage::url($micropost->user->image) }}">
                            @else 
                                <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class = "flex">
                            {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                            
                            <a class="link link-hover text-info" href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
                            
                            @if (Auth::id() != $micropost->user_id)
                                @if (Auth::user()->is_favoriting($micropost->id))
                                    {{-- アンフォローボタンのフォーム --}}
                                    <form method="POST" action="{{ route('favor.unfavorite', $micropost->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-ghost btn-sm normal-case inline">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentCollor" class="h-6 w-6 inline">
                                                <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    {{-- フォローボタンのフォーム --}}
                                    <form method="POST" action="{{ route('favor.favorite', $micropost->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-ghost btn-sm normal-case inline">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 inline">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            @else
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="btn btn-ghost btn-sm pt-5 normal-case" onclick="return confirm('Delete id = {{ $micropost->id }} ?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="" fill="red" class="h-6 w-6 inline">
                                            <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 0 0 0 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374ZM12.53 9.22a.75.75 0 1 0-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 1 0 1.06-1.06L15.31 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-1.72 1.72-1.72-1.72Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                        
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $microposts->links() }}
    @endif
</div>