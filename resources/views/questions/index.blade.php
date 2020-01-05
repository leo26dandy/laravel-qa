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
                            <div class="media-body">
                                <h4 class="my-0">
                                    {{ $question->title }}
                                </h4>
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
