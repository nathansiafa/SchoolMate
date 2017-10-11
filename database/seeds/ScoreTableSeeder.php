<?php

use Illuminate\Database\Seeder;

use App\Term;
use App\Subject;
use App\Student;
use App\Score;


class ScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
    	$periodOne = Term::where('name', '1st Period')->first();
        $periodTwo = Term::where('name', '2nd Period')->first();
        $periodThere = Term::where('name', '3rd Period')->first();
        $periodFour = Term::where('name', '4th Period')->first();
        
    	$maths = Subject::where('name', 'Mathematics')->first();
    	$biology = Subject::where('name', 'Biology')->first();
    	$physics = Subject::where('name', 'Physics')->first();
    	$geo = Subject::where('name', 'Geography')->first();

    	$student_one = Student::where('student_code', 0001)->first();
    	$student_two = Student::where('student_code', 0002)->first();
    	$student_three = Student::where('student_code', 0003)->first();


        if(DB::table('scores')->get()->count() == 0){

            // student one
            $score = new Score();
            $score->student_id = $student_one->id;
            $score->grade_id = $student_one->grade_id;
            $score->subject_id = $maths->id;
            $score->term_id = $periodOne->id;
            $score->score = 90;
            $score->save();

            $score = new Score();
            $score->student_id = $student_one->id;
            $score->grade_id = $student_one->grade_id;
            $score->subject_id = $maths->id;
            $score->term_id = $periodFour->id;
            $score->score = 65;
            $score->save();

        
            


        } else { echo "\e[scores table is not empty, therefore not seeding "; }
    }
}