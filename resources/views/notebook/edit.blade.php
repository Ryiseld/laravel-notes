@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="{{ URL::previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
					&nbsp;Edit Notebook
				</div>

				<div class="panel-body">
					<form action="{{ url('/notebook/edit', $notebook->id) }}" method="post" data-parsley-validate>
						{{ csrf_field() }}

						<div class="form-group">
							Notebook name: <input type="text" name="name" class="form-control" data-parsley-required data-parsley-maxlength="20" value="{{ $notebook->name }}">
						</div>

						<div class="form-group">
							<input type="submit" name="submit" class="form-control btn btn-default" value="Edit Notebook">
						</div>
					</form>
					
					<div class="form-group">
						<button href="{{ url('/notebook/delete', [$notebook->id]) }}" class="form-control btn btn-danger delete">
							Delete notebook
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends('scripts.delete')