<x-app-layout>

    <h2 class="headline">新規作成</h2>

    {{-- validation-errors.blade.php読み込み --}}
    <x-validation-errors :errors="$errors" />

    <!-- フォーム -->
    <div class="wrapper formBackground">
        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" autofocus required value="{{ old('title') }}">
            </div>

            <div>
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label for="body">コメント</label>
                <textarea name="body" class="body" id="body">{{ old('body') }}</textarea>
            </div>

            <label>写真評価</label>
            @foreach ($scores as $score)
                <div class="score_inline">
                    <label>{{ $score->score }}
                        <input type="radio" id="score" name="score_id" value="{{ $score->id }}"></label>
                </div>
            @endforeach

            <div>
                <label for="image">写真登録</label>
                <input type="file" id="image" name="image">
            </div>

            <input type="submit" class="submit" value="追加">
        </form>
    </div>

    <script src="{{ asset('/js/index.js') }}"></script>

</x-app-layout>
