<?php

use Illuminate\Database\Seeder;
use App\Models\Documentation;
use App\Models\Category;

class DocumentationsTableSeeder extends Seeder
{
    public function run()
    {
        Category::all()->each(function($category) {
            factory(Documentation::class, 20)->create([
                'category_id' => $category->id
            ]);
        });
    }
}
