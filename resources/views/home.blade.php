@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		@if (Session::has('success'))
			<div class="alert alert-success">
				{{ Session::get('success') }}
			</div>
		@endif

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					Notebooks

					<a href="{{ url('/notebook/create') }}" class="btn btn-primary btn-sm pull-right">New Notebook</a>
				</div>

				<div class="panel-body">
					@foreach ($notebooks as $notebook)
						<ul>
							<li>
								<a href="{{ url('/home', [$notebook->id]) }}">{{ $notebook->name }}</a>
						
								<a href="{{ url('/notebook/edit', [$notebook->id]) }}" class="btn btn-info btn-sm pull-right">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
							</li>
						</ul>
					@endforeach
				</div>
			</div>
		</div>

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					Notes

					@if (isset($notebook_name))
						for <span style="font-weight: bold">{{ $notebook_name }}</span>
					@endif

					<a href="{{ url('/note/create') }}" class="btn btn-primary btn-sm pull-right">New Note</a>
				</div>

				<div class="panel-body">
					@if (count($notes) > 0)
						<ul>
							@foreach ($notes as $note)
								<li>
									<a href="{{ url('/note', [$note->id]) }}">{{ $note->title }}</a>

									<span class="label label-default pull-right">{{ $note->notebook->name }}</span>
									<p class="note-short-content">{{ str_limit($note->content, 50, '...') }}</p>
								</li>
							@endforeach
						</ul>
					@else
						It seems like you have no notes. Would you like to <a href="{{ url('/note/create') }}">Create one</a>?
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection