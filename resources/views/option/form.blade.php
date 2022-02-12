<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $option->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('question_id') }}
            {{ Form::select('question_id', $questions , $option->question_id, ['class' => 'form-control' . ($errors->has('question_id') ? ' is-invalid' : ''), 'placeholder' => '--- Select One Question ---']) }}
            {!! $errors->first('question_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('is_correct') }}
            {{ Form::select('is_correct', [ '0' => 'Wrong Answer' , '1' => 'Correct Answer'   ], $option->is_correct, ['class' => 'form-control' . ($errors->has('is_correct') ? ' is-invalid' : ''), 'placeholder' => '-- Is this the correct answer ? ---']) }}
            {!! $errors->first('is_correct', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
