@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between w-full">
			<p class="text-gray-400 text-sm font-normal">
				<a href="/projects">My Projects </a> / {{ $project->title }}
			</p>
			<a href="/projects/create" type="button" class="btn btn-primary btn-blue">New Project</a>
		</div>
	</header>


	<main>
		<div class="lg:flex -mx-3">
			<div class="lg:w-3/4 px-3 mb-6">
				<div class="mb-8">
					<h2 class="text-lg text-gray-400 font-normal mb-3">Tasks</h2>

					@foreach ($project->tasks as $task)
						<div class="card mb-3">
							<form method="POST" action="{{ $task->path() }}">
								@method('PATCH')
								@csrf

								<div class="flex items-center">
									<input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-400' : ''}}">
									<input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
								</div>
							</form>
						</div>
					@endforeach
					<div class="card mb-3">

						<form action="{{ $project->path() . '/tasks' }}" method="POST">
							@csrf
							<input class="w-full" name="body" placeholder="Add a new task ....">
						</form>
						
					</div>
				</div>

				<div>
					<h2 class="text-gray-400 font-normal text-lg mb-3">General Notes</h2>

					<form method="POST" action="{{ $project->path() }}">
						@csrf
						@method('PATCH')

						<textarea 
							name="notes"
							class="card w-full mb-3" 
							style="min-height: 200px;" 
							placeholder="Anything special that you want to make a note of?"
						>{{ $project->notes }}</textarea>

						<button type="submit" class="btn btn-primary btn-blue">Save</button>
					</form>
				</div>

			</div>

			<div class="lg:w-1/4 px-3 lg:py-8">
				@include ('projects.card')
			</div>
		</div>	
	</main>
@endsection