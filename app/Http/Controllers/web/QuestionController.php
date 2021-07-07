<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function question($id)
    {
        $data['question']= Question::findOrFail($id);
        return view('exams/question/id')->with($data);
    }
    
}
