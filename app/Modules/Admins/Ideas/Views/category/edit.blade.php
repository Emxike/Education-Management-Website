@extends("admin.layouts.app")

@section('title', 'Update Category')

@section("content")
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Update Category</h3>
                <div class="mT-30">
                    <form action="{{ route("category.update", ["id" => $data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="category_name">Category Name</label>
                                <input type="text" class="form-control" value="{{ old("category_name", $data->category_name) }}"
                                       name="category_name" id="category_name" placeholder="Category Name">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("category.list") }}"><i
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
