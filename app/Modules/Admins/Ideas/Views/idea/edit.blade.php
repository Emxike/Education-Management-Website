@extends("admin.layouts.app")

@section('title', 'Update Category For Idea')

@section("content")
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Update Category For Idea</h3>
                <div class="mT-30">
                    <form action="{{ route("idea.update", ["id" => $data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="category">Category</label>
                                <select id="category" class="form-control" name="category">
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if(old("category", $data->category_id) == $category->id) selected="selected" @endif>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("idea.list") }}"><i
                                class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-save"
                                                                                    aria-hidden="true"></i> Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
