<?php

use Illuminate\Database\Seeder;
use App\Models\Documentation;

class DocumentationsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Documentation, 20)->create();
    }
}
