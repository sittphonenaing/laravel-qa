<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with("user")->latest()->paginate(5);//show 5 result per page and show latest result..with is to include in user and reduce query.
    
        return view('questions.index',compact('questions'));

        /**
         * We mostly use compact in Laravel to send the values to the view. Something like this:
         * 
         *     $user = User::all();
     
         *      return view('index', compact('user'));
         * 
         *      Laravel expects an array to be passed to the view helper function. Second argument in view 
         *      helper function is an array that where keys are the names of the variable and the value are the 
         *      contents of those variables. These variables will be available in our views to be used.
         */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question;
        return view('questions.create', compact($question));//Laravel expects an array to be passed to the view helper function. Second argument in view helper function is an array that where keys are the names of the variable and the value are the contents of those variables. These variables will be available in our views to be used.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title','body'));//question belong to user

        return redirect()->route('questions.index')->with('success',"Your question has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
