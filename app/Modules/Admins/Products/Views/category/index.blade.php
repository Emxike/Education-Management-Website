<h1>Example Modules</h1>
<a href="{{ route("example.add") }}">Add</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Content</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->content }}</td>
            <td>
                <a href="{{ route("example.edit", ["id" => $item->id]) }}">Edit</a>
                <a href="{{ route("example.edit", ["id" => $item->id]) }}">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
