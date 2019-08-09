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
                            <a title="Mark this answer as best answer" class="vote-accepted mt-2 " href="">
                                <i class="fas fa-check fa-2x"></i>
                                <span class="favourite-count">12345</span>
                            </a>

                        </div>
                        <div class="media-body">
                           {!! $answer->body_html !!}

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
                    <hr>
                    @endforeach

                </div>
            </div>
        </div>
    </div>