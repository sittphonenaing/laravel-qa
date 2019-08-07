@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h3>All Questions</h3>
                        <div class="ml-auto">
                        <a href="{{ route("questions.create")}}" class="btn btn-outline-secondary"> Ask Questions</a>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">
                    @include('layouts._message')
                    @foreach($questions as $question)

                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="votes">
                                    <strong>{{ $question->votes}}</strong> {{str_plural('vote', $question->votes)}}
                                </div>
                                <div class="status {{$question->status}}">
                                    <strong>{{ $question->answers_count}}</strong> {{str_plural('answer', $question->answers_count)}}
                                </div>
                                <div class="view">
                                   {{ $question->views." ".str_plural('view', $question->views)}}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question-> title }}</a> </h3>
                                    <div class="ml-auto">

                                    {{-- @if (Auth::user()->can('update',$question)) --}}
                                    @can ('update',$question)
                                        <a href="{{ route('questions.edit',$question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                    {{-- @endif --}}
                                    @endcan

                                    {{-- @if (Auth::user()->can('delete',$question)) --}}
                                    @can ('delete',$question)
                                        <form class="form-delete" action="{{ route('questions.destroy',$question->id) }}" method="POST">
                                        @method('DELETE')
                                        @CSRF
                                            <button class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endcan
                                    {{-- @endif --}}
                                    </div>

                                </div>
                                <p class="lead">
                                Asked by 
                               <a href="{{ $question->user->url}}"> {{ $question->user->name}} </a>
                               <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                {{ str_limit($question->body,250) }}                                
                            </div>                        
                        </div>
                        <hr>

                    @endforeach
                        <div class="mx-auto">
                            {{ $questions->links() }}
                            <!-- //php artisan vender:publish --tag=larvel-pagination   -->
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
