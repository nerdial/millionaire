@extends('layouts.app')

@section('template_title')
    {{ $option->name ?? 'Show Option' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Option</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('options.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $option->title }}
                        </div>
                        <div class="form-group">
                            <strong>Question Id:</strong>
                            {{ $option->question_id }}
                        </div>
                        <div class="form-group">
                            <strong>Is Correct:</strong>
                            {{ $option->is_correct }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
