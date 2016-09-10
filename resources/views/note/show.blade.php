@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $note->title }}</div>

                <div class="panel-body">
                    <p>
                        {{ $note->content }}
                    </p>

                    <hr>

                    <a href="{{ URL::previous() }}" class="pull-left btn btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>

                    <button href="{{ url('/note/delete', [$note->id]) }}" class="pull-right btn btn-danger delete" style="margin-left: 1rem"><i class="fa fa-trash delete" aria-hidden="true"></i></button>
                    <a href="{{ url('/note/edit', [$note->id]) }}" class="pull-right btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('scripts.delete')