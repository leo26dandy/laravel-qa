@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2 class="my-0">{{ $question->title }}</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to Forum</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="text-muted">
                        Asked by <strong>{{ $question->user->name }}</strong>
                        <small>{{ $question->created_date }}</small>
                    </p>

                    <hr>

                    <div class="question-body">
                        {!! nl2br(e($question->body)) !!}
                    </div>

                    <hr>

                    <div class="d-flex text-muted">
                        <span class="mr-3">{{ $question->votes }} {{ Str::plural('vote', $question->votes) }}</span>
                        <span class="mr-3">{{ $question->answers }} {{ Str::plural('answer', $question->answers) }}</span>
                        <span>{{ $question->views }} {{ Str::plural('view', $question->views) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
