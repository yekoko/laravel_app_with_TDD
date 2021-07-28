@extends('layouts.app')

@section('content')
	<div class="container">
		

		<form action="/projects" method="POST" style="padding-top: 40px;">
			@csrf
			<h3>Create a Project</h3>

			<div class="form-group">
				<label for="title">Title</label>

				<div>
					<input type="text" class="form-control" name="title" placeholder="Title">
				</div>
			</div>

			<div class="form-group">
				<label for="description">Description</label>

				<div>
					<textarea name="description" class="form-control" class="textarea"></textarea>
				</div>
			</div class="form-group">

			<div class="form-group">
				<div>
					<button type="submit" class="btn btn-primary">Create Project</button>

					<a href="/projects" type="button" class="btn btn-primary">Cancel</a>
				</div>
			</div>

		</form>
	</div>
	
@endsection