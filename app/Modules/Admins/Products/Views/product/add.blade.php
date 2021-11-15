<h1>Example Add</h1>
<form method="post" action="{{ route('example.create') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" id="name">
    @error("name")
        <h4>{{ $message }}</h4>
    @enderror
    <input type="text" name="content" id="content">
    @error("content")
        <h4>{{ $message }}</h4>
    @enderror
    <button type="submit">Add</button>
</form>
