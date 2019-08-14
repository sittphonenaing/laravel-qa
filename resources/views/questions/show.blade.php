@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-item-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                            <a href="{{ route("questions.index") }}" class="btn btn-outline-secondary"> Back to all Questions</a>
                            </div>
                        </div>                    
                    </div>
                    <hr>
    
                    <div class="media">
                        @include('shared._vote',[
                            'model' =>$question
                        ])
                        <div class="media-body">
                            {!! $question->body_html !!}  {{-- change markdown to html --}}
                               
                              <div class="row">
                                  <div class="col-4"></div>
                                  <div class="col-4"></div>
                                  <div class="col-4">
                                        {{-- author information after answer body at float right --}}
                                       
                                        <user-info :model="{{ $question }}" label="Asked"></user-info>
                                        
                                        {{-- author info end here --}}
                                  </div>
                              </div>
                                  
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('answers._index',[
        'answers_count' => $question->answers_count,
        'answers'=>$question->answers,
    ])
    @include('answers._create') 
</div>
@endsection
