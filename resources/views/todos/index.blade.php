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

        /* Floating Action Button (FAB) */
        .fab {
            position: fixed;
            bottom: 20px; /* Distance from the bottom */
            right: 20px; /* Distance from the right */
            z-index: 1000; /* Ensure it stays on top of other elements */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background-color: #007bff; /* Blue color */
            color: white;
            border: none;
            border-radius: 50%; /* Makes it circular */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adds shadow for depth */
            font-size: 24px; /* Size of the + icon */
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth hover effect */
        }

        .fab:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.1); /* Slightly enlarges on hover */
        }

        /* Alert styling */
        .alert {
            position: relative;
            transition: opacity 0.5s ease-in-out;
        }
    </style>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">

            @if (Auth::check())
    <div class="user-dropdown">
        Welcome
       <!-- <span>{{ Auth::user()->name }}</span>  -->

    </div>
@else
    <div class="auth-links">
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </div>
@endif



        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Success Alert -->
                    @if (session()->has('alert-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" data-bs-delay="3000">
                            {{ session()->get('alert-success') }}
                        </div>
                    @endif

                    <!-- Info Alert -->
                    @if (session()->has('alert-info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert" data-bs-delay="3000">
                            {{ session()->get('alert-info') }}
                        </div>
                    @endif

                    <!-- Error Alert
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-delay="3000">
                            {{ session()->get('error') }}
                        </div>
                    @endif   -->

                    @if ($todos->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
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
                                                <a class="btn btn-sm btn-danger" href="#">To-Do</a>
                                            @endif
                                        </td>
                                        <td id="outer">
                                            <a class="inner btn btn-sm btn-success" href="{{ route('todos.show', $todo->id) }}">View</a>
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

    <!-- Floating Action Button (FAB) -->
    <a href="{{ route('todos.create') }}" class="fab">
        +
    </a>

    <!-- JavaScript to Auto-Hide Alerts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select all alert elements
            const alerts = document.querySelectorAll('.alert');

            alerts.forEach(alert => {
                // Hide the alert after 3 seconds (3000 milliseconds)
                setTimeout(() => {
                    alert.style.opacity = '0'; // Fade out
                    setTimeout(() => {
                        alert.remove(); // Remove from DOM
                    }, 500); // Wait for fade-out animation to complete
                }, 3000); // Duration before hiding
            });
        });
    </script>
</x-app-layout>
