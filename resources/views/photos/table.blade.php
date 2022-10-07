<x-app-layout>

    <div class="form_header">
        <h2 class="headline">テーブル一覧</h2>
        {{-- 検索 --}}
        <form action="{{ route('table') }}" method="GET" class="form_position">
            @csrf
            <input type="search" name="title" placeholder="タイトル">
            <input type="search" name="score_id" .hover-link placeholder="写真評価">
            <input type="submit" value="検索" class="search">
        </form>
    </div>

    {{-- テーブル --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>登録者</th>
                <th>タイトル</th>
                <th>写真</th>
                <th>評価</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($photos as $photo)
                <tr>
                    <td><a href="{{ route('photos.show', $photo) }}" class="hover-link">{{ $photo->id }}</a></td>
                    <td>{{ $photo->user->name }}</td>
                    <td>{{ $photo->title }}</td>
                    <td><img src="{{ $photo->image_url }}" class="table_img">{{ $photo->image }}</td>
                    <td>{{ $photo->score->score }}

                        {{-- 検索によって星の数を表示 --}}
                        @if ($photo->score->score == $photo->score->score)
                            <div class="star_box table_star">

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

                    </td>

                    <td><a href="{{ route('photos.edit', $photo) }}" class="btn width">編集</a></td>
                    <td>
                        <form action="{{ route('photos.destroy', $photo) }}" id="form_recipe" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" id="btn" class="btn btn_red width">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{-- ページネーションリンク --}}
    {{-- {{ $photos->links() }} --}}

    <script src="{{ asset('/js/index.js') }}"></script>

</x-app-layout>
