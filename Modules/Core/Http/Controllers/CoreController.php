<?php

/** Start The NameSpace Of This Controller **/

    namespace Modules\Core\Http\Controllers;

/** End The NameSpace Of This Controller **/


/** Start Basic Declaration **/

    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;

/** End Basic Declaration **/

/** Start Login Request Declaration **/

    use Modules\Core\Http\Requests\LoginRequest;

/** End Login Request Declaration **/


/** Start Redirect Of Response Declaration **/

    use Illuminate\Http\RedirectResponse;

/** End Redirect Of Response Declaration **/


/** Start View Helper Declaration **/

    use Illuminate\Contracts\View\Factory;
    use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                            /******************************************************************************/


/** Start The CoreController **/

    class CoreController extends Controller
    {

        /** Start attendance Method **/

            /**
             * Return The Index View Of Attendance.
             * @return view
             */
            public function attendance()
            {
                return view('core::attendance.index');
            }

        /** End attendance Method **/


                            /******************************************************************************/


        /** Start academic Method **/

            /**
             * Return The Index View Of Academic.
             * @return Renderable
             */
            public function academic()
            {
                return view('core::academic.index');
            }

        /** End academic Method **/


                            /******************************************************************************/


        /** Start setting Method **/

            /**
             * Return The Index View Of Settings.
             * @return Renderable
             */
            public function setting()
            {
                return view('core::settings.index');
            }

        /** End setting Method **/

                            /******************************************************************************/


        /** Start showLoginForm Method **/

            /**
             * Display a Login Page.
             * @return Application|Factory|RedirectResponse|View
             */
            public function showLoginForm()
            {
                return AppHelper::CheckAuth("teachers.index");
            }

        /** End showLoginForm Method **/


                            /******************************************************************************/


        /** Start login Method **/

            /**
             * Check For Auth To Login Or Not.
             * @param LoginRequest $request
             * @return RedirectResponse
             */
            public function login(LoginRequest $request)
            {

                if(Auth::guard($request->guard)->attempt($request->only('username', 'password'))) {

                    return redirect()->route('home.index');

                } else {

                    return redirect()->back()->with("msg", "Your Role Or Username Or Password Were Not Correct");

                }

            }

        /** ENd login Method **/


                            /******************************************************************************/


        /** Start logout Method **/

            public function logout() {

                $guard = AppHelper::currentGuard();

                Auth::guard($guard)->logout();

                return redirect()->route("dashboard.showLoginForm");

            }

        /** End logout Method **/
    }

/** End The CoreController **/
