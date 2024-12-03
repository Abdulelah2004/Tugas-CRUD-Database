<!DOCTYPE html>
<html>

<head>
    <title>Add Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2,
        h3 {
            text-align: center;
        }

        /* Styling for table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Styling for form */
        form {
            margin-bottom: 20px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        form div {
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
            display: block;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: darkred;
        }

        /* Styling for the Export Excel button */
        .export-btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: red;
            color: white;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s;
            margin-top: 20px;
            text-align: center;
            display: block;
            width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .export-btn:hover {
            background-color: darkred;
        }

        /* Success and Error Messages */
        .message {
            margin-bottom: 20px;
            padding: 10px;
            color: white;
            font-weight: bold;
        }

        .success {
            background-color: green;
        }

        .error {
            background-color: red;
        }
    </style>
</head>

<body>
    <h2>Add Student</h2>

    <!-- Success or Error Message -->
    @if (session('success'))
    <div class="message success">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    @if (session('error'))
    <div class="message error">
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <!-- Form to Add Student -->
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div>
            <label for="npm">NPM:</label>
            <input type="text" id="npm" name="npm" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="study_program">Study Program:</label>
            <input type="text" id="study_program" name="study_program" required>
        </div>
        <button type="submit">Add Student</button>
    </form>

    <hr>

    <!-- Existing Students Table -->
    <h3>Existing Students</h3>
    @if ($students->isEmpty())
    <p>No students found.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NPM</th>
                <th>Name</th>
                <th>Study Program</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->npm }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->study_program }}</td>
                <td>
                    <!-- Delete Button -->
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Export Data Button -->
    <a href="{{ route('students.exportExcel') }}" class="btn export-btn">Export Data as Excel</a>

</body>

</html>