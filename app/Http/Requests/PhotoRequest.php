<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'title' => 'required|string|max:50',
            // 'email' => 'required|email:strict,dns|max:255',
            'email' => 'required',
            'body' => 'required|string|max:2000',
            'score_id' => 'required',
        ];

        // getNameはroute:listのNameを取得
        $route = $this->route()->getName();
        if (
            // storeとupdateアクションがrouteと一致しているかを判定
            // 登録時か更新時で且つ画像が指定された時だけ、imageを設定
            $route === 'photos.store' ||
            ($route === 'photos.update' && $this->file('image'))
        ) {
            // ファイルの拡張子がjpgかpngに該当するか確認
            $rule['image'] = 'required|file|image|mimes:jpg,png';
        }
        return $rule;
    }
}
