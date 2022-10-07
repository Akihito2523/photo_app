<x-app-layout>

    {{-- flash-message.blade.php読み込み --}}
    {{-- フラッシュメッセージ --}}
    <x-flash-message :message="session('notice')" />

    {{-- validation-errors.blade.php読み込み --}}
    {{-- エラーメッセージ --}}
    <x-validation-errors :errors="$errors" />


    <div class="main">
        <article class="mb-2">
            <h2>{{ $photo->title }}</h2>

            <p>写真登録者:{{ $photo->user->name }}</p>

            <p>メールアドレス:{{ $photo->email }}</p>

            <p>写真登録日:{{ date('Yd H:i:s', strtotime('-1 day')) < $photo->created_at ?: '' }}{{ $photo->created_at }}
            </p>

            <img src="{{ $photo->image_url }}" alt="" class="mb-4">

            <p>写真評価{{ $photo->score->score }}</p>

            <p>{{ $photo->body }}</p>

            <div class="btn_flex">

                {{-- (認可の制御)自分が投稿した記事の場合のみ、編集ボタンと削除ボタンを表示 --}}
                @can('update', $photo)
                    <a href="{{ route('photos.edit', $photo) }}" class="btn">編集</a>
                @endcan

                @can('delete', $photo)
                    <form action="{{ route('photos.destroy', $photo) }}" id="form_recipe" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除" id="btn" class="btn btn_red">
                    </form>
                @endcan

            </div>
        </article>
    </div>

    <script src="{{ asset('/js/index.js') }}"></script>

</x-app-layout>
