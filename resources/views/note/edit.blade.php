@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="{{ URL::previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
					&nbsp;Edit Note
				</div>

				<div class="panel-body">
					<form action="{{ url('/note/edit', $note->id) }}" method="post" data-parsley-validate>
						{{ csrf_field() }}
						<div class="form-group">
							<label for="notebook">Notebook:</label>
							<select name="notebook" id="notebook" class="form-control">
								@foreach ($notebooks as $notebook)
									@if ($note->notebook->id == $notebook->id)
									<option value="{{ $notebook->id }}" selected>{{ $notebook->name }}</option>
									@else
										<option value="{{ $notebook->id }}">{{ $notebook->name }}</option>
									@endif
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for="title">Note Title:</label>
							<input type="text" name="title" class="form-control" data-parsley-required data-parsley-maxlength="50" value="{{ $note->title }}">
						</div>

						<div class="form-group">
							<label for="content">Note Content:</label>
							<textarea name="content" id="content" class="form-control" cols="30" data-parsley-required>{{ $note->content }}</textarea>
						</div>

						<div class="form-group">
							<input type="submit" name="submit" class="form-control btn btn-default" value="Edit Note">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends('scripts.delete')