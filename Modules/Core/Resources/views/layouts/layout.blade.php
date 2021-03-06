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

            <a class="navbar-brand" href="{{ route('home.index') }}">

                <img class="navbar-brand-full" src="{{ asset("admin/images/logo.svg") }}" width="89" height="25" alt="CoreUI Logo">

                <img class="navbar-brand-minimized" src="{{ asset("admin/images/sygnet.svg") }}" width="30" height="30" alt="CoreUI Logo">

            </a>

            <ul class="c-header-nav" style="list-style: none;padding: 0;padding-right: 25px;margin: 0">

                <li class="c-header-nav-item dropdown d-md-down-none mx-2">

                    <div class="dropdown"  style="width: 40px;height: 40px;margin-right: 140px;">

                        <img
                            class="dropdown-toggle" id="SettingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            src="{{ asset(\Modules\Core\Http\Helper\AppHelper::photoOfCurrentAuth()) }}"
                            style="width: 100%;border-radius: 50%;height: 100%;position: absolute;left: 140px; cursor: pointer"
                        />

                        <div class="dropdown-menu" aria-labelledby="SettingMenu" style="margin-top: 6px">
                            <a class="dropdown-item" href="{{ route('dashboard.logout') }}">Log Out</a>
                        </div>
                    </div>

                </li>

            </ul>

        </header>

        {{-- Body --}}
        <div class="app-body">

            {{-- SideBar --}}
            @include('core::layouts.sidebar')

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


        {{--    Custome Js Files That Have Code I Made It   --}}

        <script src="{{ asset("admin/js/custom/SectionsStudentCreate.js") }}"></script>
        <script src="{{ asset("admin/js/custom/SectionsStudentEdit.js") }}"></script>

        <script src="{{ asset("admin/js/custom/SectionsStudentsAttendanceCreate.js") }}"></script>

        <script src="{{ asset("admin/js/custom/SectionsTeacherCreate.js") }}"></script>
        <script src="{{ asset("admin/js/custom/SubjectsTeacherCreate.js") }}"></script>

        <script src="{{ asset("admin/js/custom/SectionsTeacherEdit.js") }}"></script>
        <script src="{{ asset("admin/js/custom/SubjectsTeacherEdit.js") }}"></script>

        <script src="{{ asset("admin/js/custom/CheckAttendance.js") }}"></script>

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

            /** This If For Select Box Query **/
            $('select').selectpicker();

            $("#selectAll").click(function() {

                $("input[type=checkbox]").prop("checked", $(this).prop("checked"));

            });

            $(".selectRow").click(function() {

                    $(this).parents('tr').find("input[type=checkbox]").prop("checked", $(this).prop("checked"));

            });

        </script>

    </body>

</html>
