{{ csrf_field() }}

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label class="control-label" for="taskTitleError">Title</label>
    <input type="text" name="title" class="form-control" id="taskTitleError" value="{{ old('title', $task->title) }}">
    <p class="help-block">{{ $errors->first('title', ':message') }}</p>
</div>

<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    <label class="control-label" for="taskBodyError">Body</label>
    <textarea class="form-control" name="body" rows="3" id="taskBodyError">{{ old('body', $task->body) }}</textarea>
    <p class="help-block">{{ $errors->first('body', ':message') }}</p>
</div>

<div class="form-group">
    <label>Completed?</label>
    <label class="checkbox-inline">
        <input type="checkbox" name="completed" value="1" {{ $task->completed == 0 ?: 'checked' }}> Yes
    </label>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($submitButtonText) ? $submitButtonText : trans('admin::messages.tasks.submit_create') }}
</button>

@if (isset($resetButton))
    <button type="reset" class="btn btn-danger">Reset form</button>
@endif