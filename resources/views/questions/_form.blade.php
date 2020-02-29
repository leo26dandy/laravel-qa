 @csrf
    <div class="form-group">
        <label for="question-title">Title</label>
        <input type="text" name="title" id="question-title" value="{{ old('title', $question->title)}}" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Typing down the title here.">
        @if ($errors->has('title'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="question-body">Question</label>
        <textarea name="body" id="question-body" cols="30" rows="10" placeholder="Typing down your question here." class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body', $question->body)}}</textarea>
        @if ($errors->has('body'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('body') }}</strong>
            </div>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-sm btn-outline-primary btn-lg">{{ $buttonText }}</button>
    </div>