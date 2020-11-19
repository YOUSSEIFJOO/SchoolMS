<!DOCTYPE html>

<html>

    <head>

        {{-- Metas --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">

        {{-- Title --}}
        <title>Safwa School</title>

        <!-- Main styles for this Page-->
        <link href="{{ asset("admin/css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("admin/css/all.min.css") }}" rel="stylesheet">
        <link href="{{ asset("admin/css/login.css") }}" rel="stylesheet">

    </head>

    <body>

        <div class="container-fluid">

            <div class="no-gutter">

                <!-- The content half -->
                <div class="bg-light">

                    <div class="login d-flex align-items-center py-5">

                        <!-- Demo content-->
                        <div class="container">

                            <div class="row">

                                <div class="col-lg-10 col-xl-7 mx-auto">

                                    <h3 class="display-4 text-center">Login page!</h3>

                                    <p class="text-muted mb-4 text-center">Enter Your Username And Password To Login.</p>

                                    @if(session()->has("msg"))

                                        <p
                                            class="alert alert-danger m-0 mt-2 text-center font-xl pt-2 pr-0 pb-2 pl-0 mb-3"
                                        > ..... {{ session()->get("msg") }} ..... </p>

                                    @endif

                                    <form method="POST" action="{{ route('dashboard.login') }}">

                                        @csrf

                                        <div class="form-group mb-3">

                                            <select class="form-control rounded-pill border-0 shadow-sm px-4" name="guard" required>

                                                <option value="student"> Student </option>

                                                <option value="student"> Parent </option>

                                                <option value="teacher"> Teacher </option>

                                                <option value="employee"> Employee </option>

                                            </select>

                                        </div>

                                        <div class="form-group mb-3">

                                            <input class="form-control rounded-pill border-0 shadow-sm px-4" type="text" id="inputEmail" name="username" placeholder="Username" value="{{ old('username') }}" autocomplete="off" required autofocus />

                                        </div>

                                        @if ($errors->has('username'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('username') }}</strong>

                                            </span>

                                        @endif

                                        <div class="form-group mb-3">

                                            <input class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" type="password" id="inputPassword" name="password" placeholder="Password" required />

                                        </div>

                                        @if ($errors->has('password'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('password') }}</strong>

                                            </span>

                                        @endif

                                        <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Login</button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    <script src="{{ asset("admin/js/jquery.min.js") }}"></script>
    <script src="{{ asset("admin/js/popper.min.js") }}"></script>
    <script src="{{ asset("admin/js/bootstrap.min.js") }}"></script>
    </body>

</html>
