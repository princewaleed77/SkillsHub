<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    
        public function showExam($id)
        {
            $data['exam']= Exam::findOrFail($id);
            return view('web.exams.showExam')->with($data);
        }

        //befor start exam put into databas the exam id and user id in pivot table (exam-user)
        public function start($examId)
        {
            $user = Auth::user();
            //to add values to pivot table we use attach() method;
            // i putt () in exams method and fixed attatch->attach;
            $user->exams()->attach($examId);
            return redirect(url("exams/question/$examId"));
        }

        public function questions($id)
        {
            $data['exam']= Exam::findOrFail($id);
            return view('web.exams.questions')->with($data);
        }

        //subit answers
        public function submit($examId, Request $request)
        {
            $request->validate([
                'answers'=>"required|array",
                'answers.*'=>'required|in:1,2,3,4',
            ]);
            //calculating score
            $exam = Exam::findOrFail($examId);

            $score = 0;
            $points =0;
            $totalQuestions = $exam->questions->count();
            $user = Auth::user();
            foreach ($exam->questions as $question) {
                if (isset($request->answers[$question->id])) {
                    $userAnswer = $request->answers[$question->id];
                    $rightAnswer = $question->right_ans;
                    if ($userAnswer == $rightAnswer) {
                        $points += 1;
                    }
                    
                }
            }
            $score = ($points / $totalQuestions)*100;
           
            //calculating the actual time taken for the exam;
            //using  the row in pivot table with userid and examid;
            $pivotRow = $user->exams()->where('exam_id', $examId)->first();
            $startTime = $pivotRow->pivot->created_at;
            $submitTime = Carbon::now();
            $time_taken = $submitTime->diffInMinutes($startTime);
           
            //update pivot row
            $user->exams()->updateExistingPivot($examId,[
                'score'=>$score,
                'time_mins'=>$time_taken,
                
            ]);
            return redirect(url("exams/show/$examId"));
            
        }


    
}
