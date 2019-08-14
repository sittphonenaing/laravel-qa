<div class="media post">
    <div class="d-flex flex-column counters">
        <div class="votes">
            <strong>{{ $question->votes_count}}</strong> {{str_plural('vote', $question->votes_count)}}
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
            {{-- edit and delete button start here --}}
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
            {{-- edit and delete button end here --}}

        </div>
        <p class="lead">
        Asked by 
       <a href="{{ $question->user->url}}"> {{ $question->user->name}} </a>
       <small class="text-muted">{{ $question->created_date }}</small>
        </p>
        <div class="excerpt">
            {{ $question->excerpt }}
            {{-- default value for excerpt is 250                                 --}}
        </div>
    </div>                        
</div>