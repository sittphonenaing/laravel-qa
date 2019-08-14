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
                    @forelse($questions as $question)
                        @include('questions._excerpt')
                        
                    @empty
                        <div class="alert alert-warning">
                            <strong>Sorry</strong> There are no questions availabe.
                        </div>
                    @endforelse                        
                            {{ $questions->links() }}
                            <!-- //php artisan vender:publish --tag=larvel-pagination   -->
                       
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
