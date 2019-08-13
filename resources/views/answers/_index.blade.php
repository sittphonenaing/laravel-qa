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
                            {{-- vote button stuff start here --}}
                            @include ('shared._vote',[
                                'model' => $answer
                            ])
                            {{-- vote button stuff end here --}}
                           
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
                                    @include('shared._author',[
                                        'model' =>$answer,
                                        'label' => 'Answered'
                                    ])
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