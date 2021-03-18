<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Session;
use App\Models\SessionExercise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExercisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->delete();
        DB::table('session_exercises')->delete();
        for ($index = 1; $index <= 40; $index++) {
            $w1 = rand(0, 100);
            $w2 = rand(0, 100 - $w1);
            $w3 = rand(0, 100 - $w1 - $w2);
            $w4 = 100 - $w1 - $w2 - $w3;
            Exercise::create([
                'title' => "Exercise #{$index}",
                'memory_weight' => $w1,
                'reasoning_weight' => $w2,
                'speed_weight' => $w3,
                'attention_weight' => $w4,
                'score' => rand(10, 9000),
            ]);
        }
        $session = Session::orderBy('id')->first();
        $exercises = Exercise::all();
        foreach ($exercises as $exercise) {
            SessionExercise::create([
                'session_id' => $session->id,
                'exercise_id' => $exercise->id,
                'is_completed' => true
            ]);
            $session = Session::where('id', '>', $session->id)->first();
        }
    }
}
