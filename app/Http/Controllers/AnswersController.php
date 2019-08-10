<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use App\Question;

class AnswersController extends Controller
{
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //  questions/{question}/answer so thats why we need to add question instance
    public function store(Question $question,Request $request)
    {
            // before add data to database validate first, in laravel 5.4 validate method return array contain data that has been validated.
            // $request->validate([
            //     'body' =>required()
            // ]);
            // $question->answers()->create($request->validate([
            //     'body' =>required()
            // ]),['body'=>$request->body, 'user_id' => Auth::id()]);
            
            $question->answers()->create($request->validate([
                'body' =>'required'
            ])+['user_id' => \Auth::id()]);
            // redirect back to page
            return back()->with('success','Your answers has been submitted successfull!');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question ,Answer $answer)
    {
        $this->authorize('update',$answer);

        return view('answers.edit',compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question , Answer $answer)
    {
        $this->authorize('update',$answer);

        $answer->update($request->validate([
            'body' => 'required',
        ]));

        return redirect()->route('questions.show',$question->slug)->with('success',"Your answers has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
