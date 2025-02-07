<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            @if (Auth::check())
                <!-- Redirect to todos/index after login -->
                <div class="user-dropdown">
                    <a href="{{ route('todos.index') }}" style="text-decoration: none;">
                        Todo-List 
                    </a>
                </div>
            @else

            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 100%; max-width: 600px;">
                <div class="card-header">
                    <h3>Edit Form</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('todos.update') }}">
                        @csrf
                        @method('put')
                        <input type="hidden" name="todo_id" value="{{ $todo->id }}" />
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $todo->title }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" cols="5" rows="5">{{ $todo->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select name="is_completed" class="form-control">
                                <option disabled selected>Select option</option>
                                <option value="1" @if($todo->is_completed == 1) selected @endif>Completed</option>
                                <option value="0" @if($todo->is_completed == 0) selected @endif>Incomplete</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
