@extends('admin.layout.app')

@section('content')
    <h1>Example Modules</h1>
    <a href="{{ route("example.add") }}">Add</a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            {{--<th>Content</th>--}}
            <th></th>
        </tr>
        </thead>
        <tbody>
        {{--@foreach($data as $item)--}}
        {{--<tr>--}}
        {{--<td>{{ $item->id }}</td>--}}
        {{--<td>{{ $item->catalog_name }}</td>--}}
        {{--<td>{{ $item->content }}</td>--}}
        {{--<td>--}}
        {{--<a href="{{ route("example.edit", ["id" => $item->id]) }}">Edit</a>--}}
        {{--<a href="{{ route("example.edit", ["id" => $item->id]) }}">Delete</a>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        </tbody>
    </table>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    {{--@include("admin.components.box_head", ["title" => "Danh Sách Danh Mục", "url" => "catalog.add"])--}}
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên Danh Mục</th>
                            <th>Hình Đại Diện</th>
                            <th>Trạng Thái</th>
                            <th>Người Tạo</th>
                            <th>Ngày Tạo</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($catalogs as $catalog)--}}
                            {{--<tr>--}}
                                {{--<td>{{ $catalog->getId() }}</td>--}}
                                {{--<td>{{ $catalog->getCatalogName() }}</td>--}}
                                {{--<td>--}}
                                    {{--<img width="80px" src="{{ asset("save_image/".$catalog->getCatalogImage() )}}">--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                        {{--<span class="badge status_custom{{ $catalog->getCatalogStatus() }}">--}}
                                            {{--{{ __("messages.common_status.".$catalog->getCatalogStatus()) }}--}}
                                        {{--</span>--}}
                                {{--</td>--}}
                                {{--<td>{{ $catalog->getCreator()->getUserName() }}</td>--}}
                                {{--<td>{{ date('d/m/Y', strtotime($catalog->getCreated())) }}</td>--}}
                                {{--<td class="text-center">--}}
                                    {{--@include("admin.components.button_table", ["url" => "catalog", "id" => $catalog->getId()])--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
