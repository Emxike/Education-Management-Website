<h1>Example Update</h1>
<form method="post" action="{{ route('example.update', ["id" => $data->id]) }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" id="name" value="{{ $data->name }}">
    @error("name")
    <h4>{{ $message }}</h4>
    @enderror
    <input type="text" name="content" id="content" value="{{ $data->content }}">
    @error("content")
    <h4>{{ $message }}</h4>
    @enderror
    <button type="submit">Update</button>
</form>
