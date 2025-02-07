<x-app-layout>
    @section('styles')
    <style>
        #outer {
            display: flex;
            text-align: center;
            width: auto;
        }
        .inner {
            display: inline-block;
            margin-right: 10px;
        }
        .table td, .table th {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Todo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session()->has('alert-success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('alert-success') }}
                    </div>
                    @endif

                    @if (session()->has('alert-info'))
                    <div class="alert alert-info" role="alert">
                        {{ session()->get('alert-info') }}
                    </div>
                    @endif

                    @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                    @endif

                    @if ($todos->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Completed</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                    <tr>
                                        <td>{{ $todo->title }}</td>
                                        <td>{{ $todo->description }}</td>
                                        <td>
                                            @if ($todo->is_completed == 1)
                                                <a class="btn btn-sm btn-success" href="#">completed</a>
                                            @else
                                                <a class="btn btn-sm btn-danger" href="#">in-completed</a>
                                            @endif
                                        </td>
                                        <td id="outer">
                                            <a class="inner btn btn-sm btn-success" href="{{ route('todos.show', $todo->id) }}">View</a>
                                            <a class="inner btn btn-sm btn-info" href="{{ route('todos.edit', $todo->id) }}">Edit</a>
                                            <button class="inner btn btn-sm btn-danger" onclick="confirmDelete({{ $todo->id }})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination links -->
                        <div class="mt-4">
                            {{ $todos->links() }}
                        </div>
                    @else
                        <h4>No todos are created yet</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this todo?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            var form = document.getElementById('deleteForm');
            form.action = '/todos/destroy?id=' + id;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });
            deleteModal.show();
        }
    </script>
</x-app-layout>
