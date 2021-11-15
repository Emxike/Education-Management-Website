@extends("layouts.app")

@section("title", "Detail")

@section("style")
    <style>
        body {
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .inner-wrapper {
            position: relative;
            height: calc(100vh - 3.5rem);
            transition: transform 0.3s;
        }

        @media (min-width: 992px) {
            .sticky-navbar .inner-wrapper {
                height: calc(100vh - 3.5rem - 48px);
            }
        }

        .inner-main,
        .inner-sidebar {
            position: absolute;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
        }

        .inner-sidebar {
            left: 0;
            width: 235px;
            border-right: 1px solid #cbd5e0;
            background-color: #fff;
            z-index: 1;
        }

        .inner-main {
            right: 0;
            left: 235px;
        }

        .inner-main-footer,
        .inner-main-header,
        .inner-sidebar-footer,
        .inner-sidebar-header {
            height: 3.5rem;
            border-bottom: 1px solid #cbd5e0;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            flex-shrink: 0;
        }

        .inner-main-body,
        .inner-sidebar-body {
            padding: 1rem;
            overflow-y: auto;
            position: relative;
            flex: 1 1 auto;
        }

        .inner-main-body .sticky-top,
        .inner-sidebar-body .sticky-top {
            z-index: 999;
        }

        .inner-main-footer,
        .inner-main-header {
            background-color: #fff;
        }

        .inner-main-footer,
        .inner-sidebar-footer {
            border-top: 1px solid #cbd5e0;
            border-bottom: 0;
            height: auto;
            min-height: 3.5rem;
        }

        @media (max-width: 767.98px) {
            .inner-sidebar {
                left: -235px;
            }

            .inner-main {
                left: 0;
            }

            .inner-expand .main-body {
                overflow: hidden;
            }

            .inner-expand .inner-wrapper {
                transform: translate3d(235px, 0, 0);
            }
        }

        .nav .show > .nav-link.nav-link-faded, .nav-link.nav-link-faded.active, .nav-link.nav-link-faded:active, .nav-pills .nav-link.nav-link-faded.active, .navbar-nav .show > .nav-link.nav-link-faded {
            color: #3367b5;
            background-color: #c9d8f0;
        }

        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;
            background-color: #467bcb;
        }

        .nav-link.has-icon {
            display: flex;
            align-items: center;
        }

        .nav-link.active {
            color: #467bcb;
        }

        .nav-pills .nav-link {
            border-radius: .25rem;
        }

        .nav-link {
            color: #4a5568;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }
    </style>
@stop

@section("content")
    <div class="main-body p-0">
        <div class="inner-wrapper">
            <!-- Inner sidebar -->
            <div class="inner-sidebar">
                <!-- Inner sidebar header -->
                <div class="inner-sidebar-header justify-content-center">
                    <button class="btn btn-primary has-icon btn-block" type="button" data-toggle="modal"
                            data-target="#threadModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-plus mr-2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        New Idea
                    </button>
                </div>
                <!-- /Inner sidebar header -->

                <!-- Inner sidebar body -->
                <div class="inner-sidebar-body p-0">
                    <div class="p-3 h-100" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: -16px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper">
                                        <div class="simplebar-content" style="padding: 16px;">
                                            <nav class="nav nav-pills nav-gap-y-1 flex-column">
                                                <a href="{{ route("home") }}"
                                                   class="nav-link nav-link-faded has-icon {{ $param->category == "" ? 'active' : '' }}">All
                                                    Category</a>
                                                @foreach($categories as $item)
                                                    <a href="{{ route("home", ["category" => $item->id]) }}"
                                                       class="nav-link nav-link-faded has-icon {{ $param->category == $item->id ? 'active' : '' }}">{{ $item->category_name }}</a>
                                                @endforeach
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 234px; height: 292px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                            <div class="simplebar-scrollbar"
                                 style="height: 151px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                        </div>
                    </div>
                </div>
                <!-- /Inner sidebar body -->
            </div>
            <!-- /Inner sidebar -->

            <!-- Inner main -->
            <div class="inner-main">
                <!-- Inner main header -->
                <div class="inner-main-header">
                    <a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#"
                       data-toggle="inner-sidebar"><i class="material-icons">arrow_forward_ios</i></a>
                    <select class="custom-select custom-select-sm w-auto mr-1">
                        <option>All Category</option>
                        @foreach($categories as $item)
                            <option @if($param->category == $item->id) selected
                                    @endif value="{{ $item->id }}">{{ $item->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="input-icon input-icon-sm ml-auto w-auto">
                </span>
                </div>

                <!-- Forum Detail -->
                <div class="inner-main-body p-2 p-sm-3 forum-content position-relative">
                    <a href="{{ route("home") }}" class="btn btn-light btn-sm mb-3 has-icon"><i class="fa fa-arrow-left mr-2"></i>Back</a>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="media forum-item">
                                <a class="card-link">
                                    <img src="{{ !empty($data->avatar) ? asset("/upload/{$data->avatar}") : asset("asset/images/". ($data->sex == 1 ? 'icon_female.png' : 'icon_male.png')) }}" class="rounded-circle"
                                         width="50" alt="User"/>
                                </a>
                                <div class="media-body ml-3">
                                    <a class="text-secondary">{{ $data->staff_name }}</a>
                                    <small class="text-muted ml-2">1 hour ago</small>
                                    <h5 class="mt-1">{{ $data->title }}</h5>
                                    <div class="mt-3 font-size-sm">
                                        {!! $data->content !!}
                                    </div>
                                </div>
                                <div class="text-muted small text-center">
                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> {{ count($data->views) }}</span>
                                    <span><i class="far fa-comment ml-2"></i> {{ count($data->comments) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Comment</h3>
                    @foreach($comments as $item)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="media forum-item">
                                <a href="javascript:void(0)" class="card-link">
                                    <img src="{{ !empty($item->avatar) ? asset("/upload/{$item->avatar}") : asset("asset/images/". ($item->sex == 1 ? 'icon_female.png' : 'icon_male.png')) }}" class="rounded-circle"
                                         width="50" alt="User"/>
                                </a>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="text-secondary">{{ $item->staff_name }}</a>
                                    <small class="text-muted ml-2">1 hour ago</small>
                                    <div class="mt-3 font-size-sm">
                                        {!! $item->message !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="position-fixed" style="width: calc(100vw - 280px); bottom: 0">
                    <form action="{{ route("post-comment") }}" method="post" class="d-flex">
                        @csrf
                        <input name="idea_id" type="hidden" value="{{ $data->id }}">
                        <input type="text" name="comment"
                               class="form-control form-control-sm bg-gray-200 border-gray-200 shadow-none mb-1 mt-1 float-left"
                               placeholder="Enter Comment"/>
                        <button type="submit" class="btn btn-info float-right ml-1">Send</button>
                    </form>
                    </div>
                </div>


                <!-- /Forum Detail -->

                <!-- /Inner main body -->
            </div>
            <!-- /Inner main -->
        </div>

        <!-- New Thread Modal -->
        <div class="modal fade" id="threadModal" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="formCreateIdea">
                        <div class="modal-header d-flex align-items-center bg-primary text-white">
                            <h6 class="modal-title mb-0" id="threadModalLabel">New Idea</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       placeholder="Enter title" autofocus=""/>
                                <span class="text-danger" id="titleErrorMsg"></span>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea id="content" class="form-control summernote" rows="4"
                                          placeholder="Enter content" name="content"></textarea>
                                <span class="text-danger" id="contentErrorMsg"></span>
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category" class="form-control" name="category">
                                    <option value=""></option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="custom-file form-control-sm mt-3" style="max-width: 300px;">
                                <input type="file" class="custom-file-input" id="customFile" multiple=""/>
                                <label class="custom-file-label" for="customFile">Attachment</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section("script")
    <script>
        $(document).ready(function () {
            $("#formCreateIdea").submit(function (event) {
                var formData = {
                    title: $("#title").val(),
                    content: $("#content").val(),
                    category: $("#category").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route("post-idea") }}",
                    data: formData,
                    dataType: "json",
                    encode: true,
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function (response) {
                        $('#titleErrorMsg').text(response.responseJSON.errors.title);
                        $('#contentErrorMsg').text(response.responseJSON.errors.content);
                    },
                })

                event.preventDefault();
            });

            $("#type-select").change(function () {
                $("#formSearch").submit();
            });
        });
    </script>
@stop
