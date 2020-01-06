@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Question Session</div>

                <div class="card-body">
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $question->votes}}</strong>{{ Str::plural('vote', $question->votes) }}
                                </div>
                                <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answers}}</strong>{{ Str::plural('answer', $question->answers) }}
                                </div>
                                <div class="view">
                                    {{ $question->views . " " . Str::plural('view', $question->views) }}
                                </div>
                            </div>
                            <div class="media-body">
                                <h4 class="my-0">
                                    <a href="{{ $question->url }}">{{ $question->title }}</a>
                                </h4>
                                <p class="lead">
                                    Asked <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    at <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                <p class="my-0">
                                    {{ Str::limit($question->body, 250) }}
                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="mx-auto">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
