<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos</title>
</head>
<body>
    <h1>Todos</h1>
    <table>
        @foreach ($todos as $todo)
        <tr>
            <td>{{ $todo->title }}</td>
            <td>
                @can('update', $todo)
                    Edit
                @else
                    No Edit
                    {{-- <a href="{{ route('todos.edit', $todo->id) }}">Edit</a> --}}
                @endcan
                @can('delete', $todo)
                Delete
                @else
                    No Delete
                    {{-- <a href="{{ route('todos.edit', $todo->id) }}">Edit</a> --}}
                @endcan
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
