<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        Quản lý |
        @yield('title')
    </title>
    <style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }
    </style>
    <link href="{{ asset("asset/admin/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/css/jquery.filer.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/admin/css/dropify/dropify.min.css') }}">
    <link href="{{ asset("asset/admin/css/alert.css") }}" rel="stylesheet">
    <link href="{{ asset("asset/admin/css/style.css") }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    @yield("style")
</head>
<body class="app">
<div id="loader">
    <div class="spinner"></div>
</div>

<script>
    window.addEventListener('load', function load() {
        const loader = document.getElementById('loader');
        setTimeout(function () {
            loader.classList.add('fadeOut');
        }, 100);
    });
</script>

<div>
    <div class="sidebar">
        <div class="sidebar-inner">
            <div class="sidebar-logo">
                <div class="peers ai-c fxw-nw">
                    <div class="peer peer-greed"><a class="sidebar-link td-n" href="{{ route("dashboard") }}">
                            <div class="peers ai-c fxw-nw">
                                <div class="peer">
                                    <div class="logo"><img src="{{ asset("asset/admin/assets/static/images/logo.png") }}" alt=""></div>
                                </div>
                                <div class="peer peer-greed"><h5 class="lh-1 mB-0 logo-text">Adminator</h5></div>
                            </div>
                        </a></div>
                    <div class="peer">
                        <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i
                                    class="ti-arrow-circle-left"></i></a></div>
                    </div>
                </div>
            </div>
           @include("admin.layout.menu")
        </div>
    </div>
    <div class="page-container">
        @include("admin.layout.header")
        <main class="main-content bgc-grey-100">
            <div id="mainContent">
                @yield("content")
            </div>
        </main>
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
            <span>Copyright © 2020 Designed by
                <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.
            </span>
        </footer>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset("asset/admin/js/vendor.js") }}"></script>
<script type="text/javascript" src="{{ asset("asset/admin/js/bundle.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
<script src="{{ asset('asset/admin/js/jquery.filer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset("asset/admin/js/hullabaloo/hullabaloo.js") }}"></script>
<script src="{{ asset('asset/admin/js/dropify.min.js') }}"></script>
<script src="{{ asset('asset/admin/js/custom.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    let hulla = new hullabaloo();
    @if(session('message'))
        hulla.send('{{session('message')}}', '{{session('status')}}');
    @endif

    $('form').submit(function () {
        //run spinner when submit form
        let btn = undefined;
        if($(this).find("button[type='submit']").length > 0){
            btn = $(this).find("button[type='submit']");
        } else if($(this).find("button.btn-submit").length > 0){
            btn = $(this).find("button.btn-submit");
        }
        if(btn != undefined){
            loadSpinnerForButton(btn,true);
        }
    });

    function loadSpinnerForButton(elem,isLoading = false){
        if(elem.find('.spinner-border').length === 0){
            elem.append('<span class="spinner-border spinner-border-sm ml-1 d-none"></span>');
        }
        if(isLoading){
            elem.attr('disabled', true).find('.spinner-border').removeClass('d-none');
            elem.attr('disabled', true).find('.fa').addClass('d-none');
        }else{
            elem.attr('disabled', false).find('.spinner-border').addClass('d-none');
            elem.attr('disabled', true).find('.fa').removeClass('d-none');
        }
    }

    $(document).ready(function(){
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 350,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove:  'Supprimer',
                error:   'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        let drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element){
            console.log('Has Errors');
        });
        let drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e){
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function formatMoney(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 0 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    function deleteCommon(id) {
        $("#common_id").val(id);
    }
</script>
@yield("script")
</body>
</html>
