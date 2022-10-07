<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('photos')->first()) {
            DB::table('photos')->insert([
                [
                    'id' => '1',
                    'title' => '春',
                    'email' => 'kawabata_rio@example.com',
                    'image' => '1.jpg',
                    'body' => '春は、寒い冬から気温が上がり始め、朝晩はまだ肌寒さがあるけれど、日中が次第に暖かくなる時期。',
                    'user_id' => 1,
                    'score_id' => 1
                ],
                [
                    'id' => '2',
                    'title' => '夏',
                    'email' => 'kodama_takahiro@example.com',
                    'image' => '2.jpg',
                    'body' => '夏は、四季のひとつで、春と秋にはさまれた季節。天文学的には夏至から秋分まで。',
                    'user_id' => 1,
                    'score_id' => 2
                ],
                [
                    'id' => '3',
                    'title' => '秋',
                    'email' => 'iwai_kei@example.com',
                    'image' => '3.jpg',
                    'body' => '秋は、四季の1つであり夏の後、冬の前に位置する',
                    'user_id' => 1,
                    'score_id' => 3
                ],
                [
                    'id' => '4',
                    'title' => '冬',
                    'email' => 'tanama_ken@example.com',
                    'image' => '4.jpg',
                    'body' => '冬は、四季の一つであり、一年の中で最も寒い期間・季節を指す。',
                    'user_id' => 1,
                    'score_id' => 4
                ],
                [
                    'id' => '5',
                    'title' => '春',
                    'email' => 'kawabata_rio@example.com',
                    'image' => '5.jpg',
                    'body' => '春は、寒い冬から気温が上がり始め、朝晩はまだ肌寒さがあるけれど、日中が次第に暖かくなる時期。',
                    'user_id' => 1,
                    'score_id' => 1
                ],
                [
                    'id' => '6',
                    'title' => '夏',
                    'email' => 'kodama_takahiro@example.com',
                    'image' => '6.jpg',
                    'body' => '夏は、四季のひとつで、春と秋にはさまれた季節。天文学的には夏至から秋分まで。',
                    'user_id' => 1,
                    'score_id' => 2
                ],
                [
                    'id' => '7',
                    'title' => '秋',
                    'email' => 'iwai_kei@example.com',
                    'image' => '7.jpg',
                    'body' => '秋は、四季の1つであり夏の後、冬の前に位置する',
                    'user_id' => 1,
                    'score_id' => 3
                ],
                [
                    'id' => '8',
                    'title' => '冬',
                    'email' => 'tanama_ken@example.com',
                    'image' => '8.jpg',
                    'body' => '冬は、四季の一つであり、一年の中で最も寒い期間・季節を指す。',
                    'user_id' => 1,
                    'score_id' => 4
                ],
                [
                    'id' => '9',
                    'title' => '秋',
                    'email' => 'iwai_kei@example.com',
                    'image' => '9.jpg',
                    'body' => '秋は、四季の1つであり夏の後、冬の前に位置する',
                    'user_id' => 1,
                    'score_id' => 3
                ],
                [
                    'id' => '10',
                    'title' => '冬',
                    'email' => 'tanama_ken@example.com',
                    'image' => '10.jpg',
                    'body' => '冬は、四季の一つであり、一年の中で最も寒い期間・季節を指す。',
                    'user_id' => 1,
                    'score_id' => 4
                ],
            ]);
        }
    }
}
