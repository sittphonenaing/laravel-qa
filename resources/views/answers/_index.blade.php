<div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <h2>{{ $answers_count ." ". str_plural("Answer",$answers_count) }}</h2>
                    </div>
                    <hr>
                    @include('layouts/_message')

                    @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-control">
                            <a title="This answer is very useful" class="vote-up">
                                <i class="fas fa-caret-up fa-2x"></i>
                            </a>
                            <span class="votes-count" >1234</span>
                            <a title="This answer is not useful" class="vote-down off"><i class="fas fa-caret-down fa-2x"></i></a>
                            <a title="Mark this answer as best answer" 
                                class="{{ $answer->status }} mt-2 " onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit()">
                                <i class="fas fa-check fa-2x"></i>
                                <span class="favorite-count">{{ $question->favorites_count }}</span>
                            </a>
                        <form id="accept-answer-{{ $answer->id }}" action="{{ route('answer.accept',$answer->id) }}" method="POST" style="display:none;">
                        @csrf
                        </form>

                        </div>
                        <div class="media-body">
                           {!! $answer->body_html !!}

                           <div class="row">
                               <div class="col-4">
                                    {{-- edit and delete button start here --}}
                                    <div class="ml-auto">

                                        {{-- @if (Auth::user()->can('update',$answer)) --}}
                                        @can ('update',$answer)
                                            <a href="{{ route('questions.answer.edit',[$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        {{-- @endif --}}
                                        @endcan
    
                                        {{-- @if (Auth::user()->can('delete',$answer)) --}}
                                        @can ('delete',$answer)
                                            <form class="form-delete" action="{{ route('questions.answer.destroy',[$question->id, $answer->id]) }}" method="POST">
                                            @method('DELETE')
                                            @CSRF
                                                <button class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                        {{-- @endif --}}
                                        </div>
                                        {{-- edit and delete button end here --}}    
                               </div>
                               <div class="col-4"></div>
                               <div class="col-4">
                                     {{-- author information after answer body at float right --}}
                                    <div class="float-right">
                                        <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                            <div class="media mt-2">
                                            <a href="{{ $answer->user->url }}" class="pr-2">
                                                    <img src="{{ $answer->user->avatar }}" >
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{ $answer->user->url }}" >{{ $answer->user->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- author info end here --}}
                               </div>
                           </div>

                          

                        </div>
                    </div>
                    <hr>
                    @endforeach

                </div>
            </div>
        </div>
    </div>