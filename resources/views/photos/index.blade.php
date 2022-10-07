<x-app-layout>

    {{-- flash-message.blade.php読み込み --}}
    {{-- フラッシュメッセージ --}}
    <x-flash-message :message="session('notice')" />

    <div class="form_header">
        <h2 class="headline">写真一覧</h2>
        {{-- 検索 --}}
        <form action="{{ route('photos.index') }}" method="GET" class="form_position">
            @csrf
            <input type="search" name="title" placeholder="タイトル" value="{{ old('title', $photos['title']) }}">

            <input type="search" name="score_id" placeholder="写真評価">
            <input type="submit" value="検索" class="search">

        </form>
    </div>

    @foreach ($photos as $photo)
        <div class="container">
            <div class="row">
                <div class="image">
                    <img src="{{ $photo->image_url }}" alt="">
                    <div class="details">
                        <h2>{{ $photo->title }}</h2>

                        <p>写真評価 : {{ $photo->score->score }}</p>

                        {{-- 検索によって星の数を表示 --}}
                        @if ($photo->score->score == $photo->score->score)
                            <div class="star_box">

                                @switch($photo->score->score)
                                    @case(1)
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                    @break

                                    @case(2)
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                    @break

                                    @case(3)
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                    @break

                                    @case(4)
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                    @break

                                    @case(5)
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                        <img src="{{ asset('images/スター.png') }}" alt="写真" class="star">
                                    @break

                                    @default
                                @endswitch

                            </div>
                        @endif

                        <div class="hover-title">
                            <a href="{{ route('photos.show', $photo) }}" class="hover-link">写真詳細</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- ページネーションリンク --}}
    {{ $photos->links() }}

</x-app-layout>
