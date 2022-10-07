<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Session\Session;
// use Illuminate\Contracts\Session\Session;
// use Illuminate\Support\Facades\Session;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 検索機能
        $title = $request->title;
        $score_id = $request->score_id;
        $params = $request->query();
        $photos = Photo::search($params)->latest()->paginate(4);
        $photos->appends(compact('title', 'score_id'));
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scores = Score::all();
        return view('photos.create', compact('scores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        $photo = new Photo($request->all());
        // ログインユーザーのIDを取得
        $photo->user_id = Auth::user()->id;
        // 画像を取得
        $file = $request->file('image');
        $photo->image = self::createFileName($file);

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録
            $photo->save();

            if (!Storage::putFileAs('images/photos', $file, $photo->image)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。');
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }
        return redirect()
            ->route('photos.index', $photo)
            ->with('notice', '写真を投稿しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        $scores = Score::all();
        return view('photos.show', compact('photo', 'scores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $scores = Score::all();
        return view('photos.edit', compact('photo', 'scores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PhotoRequest  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoRequest $request, Photo $photo)
    {
        $photo->fill($request->all());

        if ($request->user()->cannot('update', $photo)) {
            return redirect()
                ->route('photos.show', $photo)
                ->withErrors('自分の記事以外は更新できません');
        }

        $file = $request->file('image');
        if ($file) {
            $delete_file_path = $photo->image_path;
            $photo->image = self::createFileName($file);
        }

        // トランザクション開始
        // beginTransactionからDB::commit
        DB::beginTransaction();
        try {
            // 更新
            $photo->save();

            if ($file) {
                // 画像をアップロードする
                if (!Storage::putFileAs('images/photos', $file, $photo->image)) {
                    // 例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの保存に失敗しました。');
                }

                // 過去の画像ファイルを削除
                if (!Storage::delete($delete_file_path)) {
                    //アップロードした画像を削除する
                    Storage::delete($photo->image_path);
                    //例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの削除に失敗しました。');
                }
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()
            ->route('photos.show', $photo)
            ->with('notice', '写真を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        // トランザクション開始
        DB::beginTransaction();
        try {
            $photo->delete();

            // 画像削除
            if (!Storage::delete($photo->image_path)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの削除に失敗しました。');
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('photos.index')
            ->with('notice', '写真を削除しました');
    }

    // テーブルメソッド
    public function table(Request $request)
    {
        $title = $request->title;
        $score_id = $request->score_id;

        $params = $request->query();
        $photos = Photo::search($params)->latest()->paginate(10);
        $photos->appends(compact('title', 'score_id'));
        return view('photos.table', compact('photos'));
    }

    private static function createFileName($file)
    {
        return date('YmdHis') . '_' . $file->getClientOriginalName();
    }
}
