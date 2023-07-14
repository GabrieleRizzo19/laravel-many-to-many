<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type_ids = Type::all()->pluck('id')->toArray();
        $technology_ids = Technology::all()->pluck('id')->toArray();

        

        for($i = 0; $i < 10; $i++){

            $numberOfTechnology = rand(1,3);
            $technologyArray = [];
            for($j=0; $j<$numberOfTechnology; $j++){

                $technologyToAdd = $faker->randomElement($technology_ids);

                if( !(in_array($technologyToAdd, $technologyArray)) ){
                    $technologyArray[] = $technologyToAdd;
                }else{
                    $j--;
                }
            }

            $newProject = new Project();

            $newProject->title = $faker->words(3,true);
            $newProject->description = $faker->paragraph();
            $randNum = rand(1,3);
            $newProject->image = "placeholders/$randNum.png";
            $newProject->type_id = $faker->randomElement($type_ids);
            $newProject->save();

            $newProject->technology()->sync($technologyArray);
        }
    }
}
