<x-app-layout>

    <h2 class="headline">写真登録編集</h2>

    {{-- validation-errors.blade.php読み込み --}}
    <x-validation-errors :errors="$errors" />

    <!-- フォーム -->
    <div class="wrapper formBackground">
        <form action="{{ route('photos.update', $photo) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" autofocus required value="{{ old('title', $photo->title) }}">
            </div>

            <div>
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email', $photo->email) }}">
            </div>

            <div>
                <label for="body">コメント</label>
                <textarea name="body" class="body" id="body">{{ old('body', $photo->body) }}</textarea>
            </div>

            <label>写真評価</label>
            @foreach ($scores as $score)
                <div class="score_inline">
                    <label>{{ $score->score }}
                        <input type="radio" id="score" name="score_id" value="{{ $score->id }}" {{ old('score', $photo->score_id) === $score->id ? 'checked' : '' }}></label>
                </div>
            @endforeach

            <div>
                <label for="image">写真登録</label>
                <img src="{{ $photo->image_url }}" alt="">
                <input type="file" id="image" name="image">
            </div>

            <input type="submit" class="submit" value="更新">
        </form>
    </div>

</x-app-layout>
