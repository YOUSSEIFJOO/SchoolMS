<!DOCTYPE html>

<html lang="en">

    <head>

        {{-- Metas --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        {{-- Title --}}
        <title>Safwa School</title>

        <!-- Icons-->
        <link href="{{ asset("admin/css/coreui-icons.min.css") }}" rel="stylesheet">
        <link href="{{ asset("admin/css/flag-icon.min.css") }}" rel="stylesheet">
        <link href="{{ asset("admin/css/all.min.css") }}" rel="stylesheet">
        <link href="{{ asset("admin/css/simple-line-icons.css") }}" rel="stylesheet">

        <!-- Main styles for this application-->
        <link href="{{ asset("admin/css/style.css") }}" rel="stylesheet">
        <link href="{{ asset("admin/css/pace.min.css") }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
        <link href="{{ asset("admin/css/myStyle.css") }}" rel="stylesheet">

    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

        {{-- Header --}}
        <header class="app-header navbar">

            <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="#">

                <img class="navbar-brand-full" src="{{ asset("admin/images/logo.svg") }}" width="89" height="25" alt="CoreUI Logo">

                <img class="navbar-brand-minimized" src="{{ asset("admin/images/sygnet.svg") }}" width="30" height="30" alt="CoreUI Logo">

            </a>

        </header>

        {{-- Body --}}
        <div class="app-body">

            {{-- SideBar --}}
            @include('core::layouts.sidebar')

{{--            style="background-image: url('{{ asset("admin/images/ab.jpg") }}'); background-size:cover"--}}
            {{-- SubBar --}}
            <main class="main">

                <div class="container-fluid">

                    {{-- The Main Content --}}
                    @yield('content')

                </div>

            </main>

        </div>

        {{-- Scripts --}}

        <!-- Global site tag (gtag.js) - Google Analytics-->
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>

        <!-- CoreUI and necessary plugins-->
        <script src="{{ asset("admin/js/jquery.min.js") }}"></script>
        <script src="{{ asset("admin/js/popper.min.js") }}"></script>
        <script src="{{ asset("admin/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("admin/js/pace.min.js") }}"></script>
        <script src="{{ asset("admin/js/perfect-scrollbar.min.js") }}"></script>
        <script src="{{ asset("admin/js/coreui.min.js") }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <script src="{{ asset("admin/js/image-preview.js") }}"></script>

        <script>

            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            // Shared ID
            gtag('config', 'UA-118965717-3');
            // Bootstrap ID
            gtag('config', 'UA-118965717-5');

            $(document).ready(function(){

                $('p.alert').fadeIn().delay(1000).fadeOut();

                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });


                $("#checkboxCreate[type=checkbox]").each(function() {

                    $(this).change(function () {

                        if($(this).is(":checked")) {
                            $(this).prev("#textCheckbox").attr("value", "present");
                        } else {
                            $(this).prev("#textCheckbox").attr("value", "absent");
                        }

                    });

                });

                // Here.
                $('.select').selectpicker();

                $("#class_id_student").on('change', function(e) {

                    let class_id = e.target.value;

                    $.get('create/section?class_id=' + class_id , function(data) {

                        $('#section_id_student').empty();

                        $('#section_id_student').append(`<option disabled selected> -- Select Section -- </option><option value=""> No Selected </option>`);

                        $.each(data, function(index, section) {

                            $('#section_id_student').append('<option value="' + section.id + '">' + section.name + '</option>');

                        });

                    });

                });
            });

        </script>

    </body>

</html>
