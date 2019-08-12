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
                        <div class="d-flex flex-column vote-control">
                            {{-- vote up button start here --}}
                            <a title="This question is very useful" 
                            class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit()">
                                <i class="fas fa-caret-up fa-2x"></i>
                            </a>

                            <form id="up-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            {{-- vote up button end here --}}

                            <span class="votes-count" >{{ $question->votes_count }}</span>

                            {{-- vote down button start here --}}
                            <a title="This question is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit()">
                                <i class="fas fa-caret-down fa-2x"></i>
                            </a>
                            <form id="down-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            {{-- favorite button start here --}}
                            <a title="click to mark as favorite questions(click again to undo)" 
                                class="favorite mt-2 {{ Auth::guest() ? "off" : ($question->is_favorited ? "favorited" : "") }}" 
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorite-count">{{ $question->favorites_count }}</span>
                            </a>

                            <form id="favorite-question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="POST" style="display:none;">
                                @csrf
                                @if ($question->is_favorited)
                                    @method ('DELETE')
                                @endif
                            </form>
                            {{-- favorite button end here --}}

                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}  {{-- change markdown to html --}}
                               {{-- author information after answer body at float right --}}
                               <div class="float-right">
                                      <span class="text-muted">Asked {{ $question->created_date }}</span>
                                           <div class="media mt-2">
                                           <a href="{{ $question->user->url }}" class="pr-2">
                                                   <img src="{{ $question->user->avatar }}" >
                                           </a>
                                           <div class="media-body mt-1">
                                               <a href="{{ $question->user->url }}" >{{ $question->user->name }}</a>
                                           </div>
                                       </div>
                                  </div>
                                  {{-- author info end here --}}
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
