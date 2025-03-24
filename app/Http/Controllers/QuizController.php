<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

class QuizController extends Controller
{
    public function store(Request $request) {
        $quiz = new Quiz();
        $quiz->save();
        
        foreach ($request->questions as $questionObj) {
            $question = new Question();
            $question->quiz_id = $quiz->id;
            $question->question = $questionObj["question"];
            $question->save();  

            foreach ($questionObj["answers"] as $value) 
            {
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->answer = $value["answer"];
                $answer->save();

                if (!empty($value["correctAnswer"])) {
                    $question->answer_id = $answer->id;
                    $question->save();
                }
            }
        }
        return [
            'redirect' => '/dashboard'
        ];
    }
}
