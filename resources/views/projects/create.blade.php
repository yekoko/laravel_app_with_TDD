@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center">
    <div class="w-1/2">
		<div class="card">
			<div class="text-lg mb-5 border-b-2 border-fuchsia-600 -mx-5">
                <div class="px-6 pb-2">
                   <h3>Create a Project</h3>
                </div>
            </div>
			<form action="/projects" method="POST" class="px-8 pt-6 pb-8 mb-4">
				@csrf				

				<div class="mb-4">
					<label for="title" class="label-form">Title</label>

					
					<input type="text" class="input-form" name="title" placeholder="Title">
					@error('title')
                        <span class="alert-text">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					
				</div>

				<div class="mb-8">
					<label for="description" class="label-form">Description</label>

					 
					<textarea name="description" class="input-form" class="textarea"></textarea>

					@error('description')
                        <span class="alert-text">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					 
				</div>

				<div class="lg:flex items-center justify-center">
					 
					<button type="submit" class="btn btn-primary btn-blue mr-6">Create Project</button>

					<a href="/projects" type="button" class="btn btn-primary btn-red">Cancel</a>
					
				</div>

			</form>
		</div>
	</div>
</div>
	
@endsection