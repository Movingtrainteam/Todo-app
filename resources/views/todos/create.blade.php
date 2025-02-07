<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            <a class="navbar-brand" href="{{ route('todos.index') }}">Todo-list</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 100%; max-width: 600px;">
                <div class="card-header">
                    <h3>Todo App</h3>
                </div>
                <div class="card-body">

                    <!-- /resources/views/post/create.blade.php -->



 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create Post Form -->
                    <form method="post" action="{{ route('todos.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text"k,,php name="title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" cols="5" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
