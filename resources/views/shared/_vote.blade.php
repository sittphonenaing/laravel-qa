@if($model instanceof App\Question)
    @php
        $name='question';
        $firstURISegment='questions';
    @endphp

@elseif($model instanceof App\Answer)
    @php
        $name='answer';
        $firstURISegment='answer'; 
    @endphp
@endif

@php
    $formId=$name. "-" .$model->id; 
    $formAction="{$firstURISegment}/{$model->id}/vote";

@endphp

<div class="d-flex flex-column vote-control">
    {{-- vote up button start here --}}
    <a title="This {{ $name }} is very useful" 
    class="vote-up {{ Auth::guest() ? 'off' : '' }}"
    onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit()">
        <i class="fas fa-caret-up fa-2x"></i>
    </a>

    <form id="up-vote-{{ $formId }}" action="/{{ $formAction }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    {{-- vote up button end here --}}

    <span class="votes-count" >{{ $model->votes_count }}</span>

    {{-- vote down button start here --}}
    <a title="This {{ $name }} is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
        onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit()">
        <i class="fas fa-caret-down fa-2x"></i>
    </a>
    <form id="down-vote-{{ $name }}-{{ $model->id }}" action="/{{ $formAction }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    {{-- vote down button end here --}}

   @if($model instanceof App\Question)
        @include('shared._favorite',[
            'model' => $model
        ])   
   @elseif($model instanceof App\Answer)
        @include('shared._accept',[
       'model' => $model
   ])
@endif

</div>