<!DOCTYPE html>
<html>
<head>
    <title>Office Management</title>

    
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">


    <nav class="bg-blue-600 p-4 text-white flex justify-between">
        <h1 class="text-lg font-bold">Office Management</h1>

        <div>
            <a href="{{ route('companies.index') }}" class="mr-4">Companies</a>
            <a href="{{ route('employees.index') }}">Employees</a>
        </div>
    </nav>

    <div class="p-6">
        @yield('content')
    </div>
    @yield('scripts')

</body>
</html>