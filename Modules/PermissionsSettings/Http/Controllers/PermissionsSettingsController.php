<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\PermissionsSettings\Http\Controllers;

/** End The NameSpace Of This Controller **/


/** Start Basic Declaration **/

    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Routing\Controller;
    use Illuminate\Http\Request;
    use Exception;

/** End Basic Declaration **/


/** Start View Helper Declaration **/

    use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start Redirect Of Response Declaration **/

    use Illuminate\Http\RedirectResponse;

/** End Redirect Of Response Declaration **/


/** Start Related Spatie Package Declaration **/

    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

/** End Related Spatie Package Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The PermissionsSettingsController **/

    class PermissionsSettingsController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of Role Model. **/
            private $role;

        /** End Declaration Properties Of This Controller **/


                    /******************************************************************************/


        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Student Model. **/
//                $this->role = new Student;

            }

        /** End The Construct Method **/


        /******************************************************************************/

        /** Start Index Method **/

            /**
             * Display a listing of the resource.
             * @param Request $request
             * @return Application|Factory|RedirectResponse|View
             */
            public function index(Request $request)
            {
                try {

                    /** Start Pagination Number **/

                        /**
                         ** Get The Pagination Number.
                         ** Passing Pagination Number To Index View For Showing This Number Under Showing Data.
                         **/
                        $paginationNumber = AppHelper::PAGINATE_NUMBER;

                    /** End Pagination Number **/


                    /** Start Roles Variable **/

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["name"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
//                        $roles = AppHelper::QuerySearch($this->student, $selectProperties, "name", "desc", $request, $whereProperties);

                    $roles = DB::select("select id, name from roles");

                    /** End Roles Variable **/

                    return view('permissionsSettings::index', compact("roles", "paginationNumber"));

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Permissions And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("permissionsSettings.index");

                }
            }

        /** End Index Method **/


        public function search(Request $request){

            $search = $request->name;

            if ($search != " "){

                $roles = DB::table('roles')->where("name","LIKE", "%" . $search . "%")->get();

                if(count($roles) > 0){
                    return view('permissionsSettings::index', compact("roles"))->withQuery($search);
                }

            }

            return view("permissionsSettings::index")->withMessage("No Found!");

        }


                        /******************************************************************************/


        /** Start create Method **/

            /**
             * Show the form for creating a new resource.
             * @return Renderable
             */
            public function create()
            {
                return view('permissionsSettings::create');
            }

        /** End create Method **/


                        /******************************************************************************/

        /** Start Store Method **/

            /**
             * Store a newly created resource in storage.
             * @param Request $request
             * @return RedirectResponse
             */
            public function store(Request $request)
            {
                $role = Role::create(['guard_name' => $request->role, 'name' => $request->role]);

                foreach($request->except(["role", "_token"]) as $permission) {

                    $permissions = Permission::create(['guard_name' => $request->role, 'name' => $permission]);

                }

                $role->syncPermissions($permissions);

                return redirect()->route("permissions.index");
            }

        /** End Store Method **/


                        /******************************************************************************/

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            return view('permissionssettings::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            return view('permissionssettings::edit');
        }

        /**
         * Update the specified resource in storage.
         * @param Request $request
         * @param int $id
         * @return Renderable
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         * @param int $id
         * @return Renderable
         */
        public function destroy($id)
        {
            //
        }
    }

/** End The PermissionsSettingsController **/
