<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
        'name' => STR::random(12),
        'description' => STR::random(40),
        'image' => STR::random(12),
        'author' => STR::random(12),
        'author_id' => '1',
        'publication' => '2019-08-13'
            ]);
    }
}
