@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <div class="d-flex align-items-center">
                        <h4>Forum Session</h4>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Create the question</a>
                        </div>
                    </div>
                </div>

                @include('layouts._messages')

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
                                <div class="d-flex align-items-center">
                                    <h4 class="my-0">
                                        <a href="{{ $question->url }}">{{ $question->title }}</a>
                                    </h4>
                                    <div class="ml-auto">
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
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
