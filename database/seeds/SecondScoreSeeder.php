<?php

use Illuminate\Database\Seeder;

use App\Term;
use App\Subject;
use App\Student;
use App\Score;

class SecondScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $periodOne = Term::where('name', '1st Period')->first();
        $periodTwo = Term::where('name', '2nd Period')->first();
        $periodThere = Term::where('name', '3rd Period')->first();
        $periodFour = Term::where('name', '4th Period')->first();
        
    	$maths = Subject::where('name', 'Mathematics')->first();
    	$biology = Subject::where('name', 'Biology')->first();
    	$physics = Subject::where('name', 'Physics')->first();
    	$geo = Subject::where('name', 'Geography')->first();

    	$student = Student::where('student_code', 0002)->first();


        $score = new Score();
            $score->student_id = $student->id;
            $score->grade_id = $student->grade_id;
            $score->subject_id = $maths->id;
            $score->term_id = $periodOne->id;
            $score->score = 99;
            $score->save();

            $score = new Score();
            $score->student_id = $student->id;
            $score->grade_id = $student->grade_id;
            $score->subject_id = $maths->id;
            $score->term_id = $periodFour->id;
            $score->score = 65;
            $score->save();

            $score = new Score();
            $score->student_id = $student->id;
            $score->grade_id = $student->grade_id;
            $score->subject_id = $biology->id;
            $score->term_id = $periodThere->id;
            $score->score = 60;
            $score->save();

            $score = new Score();
            $score->student_id = $student->id;
            $score->grade_id = $student->grade_id;
            $score->subject_id = $geo->id;
            $score->term_id = $periodOne->id;
            $score->score = 57;
            $score->save();

            $score = new Score();
            $score->student_id = $student->id;
            $score->grade_id = $student->grade_id;
            $score->subject_id = $physics->id;
            $score->term_id = $periodFour->id;
            $score->score = 87;
            $score->save();

            $score = new Score();
            $score->student_id = $student->id;
            $score->grade_id = $student->grade_id;
            $score->subject_id = $biology->id;
            $score->term_id = $periodOne->id;
            $score->score = 70;
            $score->save();
    }
}