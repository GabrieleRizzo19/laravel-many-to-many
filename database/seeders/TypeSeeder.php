<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeArray = config('typeList');
        foreach ($typeArray as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->save();
        }

    }
}
