<x-app-layout>
    @section('styles')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .title-card {
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fbfbfb; /* Updated title card background color */
        }
        .title-card h1 {
            font-size: 1.3rem;
            margin-bottom: 0;
            color: #131313;
            word-wrap: break-word; /* Ensures long titles wrap */
        }
        .details-card {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #f5f5f5; /* Calm grey background */
            position: relative;
        }
        .details-card p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #5d6d7e;
            word-wrap: break-word; /* Ensures long descriptions wrap */
        }

        /* Action Dropdown */
        .action-dropdown {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .action-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s ease;
        }
        .action-button:hover {
            background-color: #0056b3;
        }

        /* Dropdown Content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
            top: 30px;
            border-radius: 4px;
        }
        .dropdown-content a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s ease;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Keep Dropdown Open */
        .action-dropdown.open .dropdown-content {
            display: block;
        }
    </style>
    @endsection

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            @if (Auth::check())
                <div class="user-dropdown">
                    <a href="{{ route('todos.index') }}" style="text-decoration: none;">
                        Todo-List
                    </a>
                </div>
            @endif
        </h2>
    </x-slot>

    <div class="container">
        <!-- Title Card -->
        <div class="title-card">
            <h1>{{ $todo->title }}</h1>
        </div>

        <!-- Details/Description Card -->
        <div class="details-card">
            <p>{{ $todo->description }}</p>

            <!-- Action Dropdown -->
            <div class="action-dropdown" onclick="toggleDropdown(this)">
                <button class="action-button">Action</button>
                <div class="dropdown-content">
                    <a href="{{ route('todos.edit', $todo->id) }}" class="dropdown-item">Edit</a>
                    <form action="{{ route('todos.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $todo->id }}">
                        <button type="submit" class="dropdown-item text-red-500 hover:text-red-700" style="color:red; margin-left: 11px; padding-down:9px">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(element) {
            // Toggle the 'open' class on the dropdown
            element.classList.toggle('open');
        }

        // Close dropdown if clicking outside
        document.addEventListener('click', function (event) {
            const dropdowns = document.querySelectorAll('.action-dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('open');
                }
            });
        });
    </script>
</x-app-layout>
