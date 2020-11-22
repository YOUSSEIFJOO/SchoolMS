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

        /** Start Index Method **/

            /**
             * Display a listing of the resource.
             * @return Application|Factory|RedirectResponse|View
             */
            public function index()
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

                        /** Select Properties From Table Roles. **/
//                        $roles = DB::select("select id, name from roles");

                        $roles = Role::all();

                    /** End Roles Variable **/

                    return view('permissionsSettings::index', compact("roles", "paginationNumber"));

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Permissions And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("permissions.index");

                }
            }

        /** End Index Method **/


                        /******************************************************************************/


        /** Start search Method **/

            /**
             * Display a listing of the resource.
             * @param Request $request
             * @return Application|Factory|RedirectResponse|View
             */
            public function search(Request $request){

                try {

                    /** Start Pagination Number **/

                        /**
                         ** Get The Pagination Number.
                         ** Passing Pagination Number To Index View For Showing This Number Under Showing Data.
                         **/
                        $paginationNumber = AppHelper::PAGINATE_NUMBER;

                    /** End Pagination Number **/

                    /** Get Value Or Values From Table Roles If Search Value Is Similar To Value I Table Roles. **/
                    $roles = DB::table('roles')->where("name","LIKE", "%" . $request->name . "%")->get();

                    return view('permissionsSettings::index', compact("roles", "paginationNumber"));

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Permissions And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("permissions.index");

                }

            }

        /** End search Method **/


                        /******************************************************************************/


        /** Start create Method **/

            /**
             * Show the form for creating a new resource.
             * @return Application|Factory|RedirectResponse|View
             */
            public function create()
            {
                try {

                    return view('permissionsSettings::create');

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Permissions And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("permissions.index");

                }
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
                try {

                    $role_guard = explode("_", $request->role);

                    $roleName = $role_guard[0];

                    $guardName = $role_guard[1];

                    /** Create New Role. **/
                    $role = Role::create(['guard_name' => $guardName, 'name' => $roleName]);

                    $permissions = [];

                    /** Create New Permissions. **/
                    foreach($request->except(["role", "_token"]) as $permission) {

                         Permission::create(['guard_name' => $guardName, 'name' => $permission]);

                        $permissions[] = $permission;


                    }

                    /** Give The New Permissions ($permissions) To The New Role ($role). **/
                    $role->syncPermissions($permissions);

                    return redirect()->route("permissions.index");

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Permissions And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("permissions.index");

                }
            }

        /** End Store Method **/


                        /******************************************************************************/


        /** Start edit Method **/

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Application|Factory|RedirectResponse|View
         */
        public function edit(int $id)
        {
            try {

                /** Start Roles Variable **/

                    /** Select Properties From Table Roles. **/
                    $role = DB::select("select id, name, guard_name from roles where id = $id");

                /** End Roles Variable **/

                $guardName = $role[0]->guard_name;


                /** Start Permissions Variable **/

                    $permissions = DB::select("select id, name from permissions where guard_name = '$guardName'");

                /** End Permissions Variable **/


                $permissionsArray = [];

                foreach($permissions as $permission) {
                    $permissionsArray[] = $permission->name;
                }


                return view('permissionsSettings::edit', compact("role", "permissionsArray"));

            } catch (Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Permissions And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("permissions.index");

            }
        }

        /** End edit Method **/


                        /******************************************************************************/


        /** Start update Method **/

        /**
         * Update the specified resource in storage.
         * @param Request $request
         * @param int $id
         * @return Renderable
         */
        public function update(Request $request, int $id)
        {

            $permissions = $request->permissions;

            $guardName = $request->guard;

            $role = Role::findById($id, $guardName);

//            $permissions = DB::select("select name from permissions where guard_name = '$guardName'");



            foreach($permissions as $permission) {
//                dd($permission->name);
//                $role->revokePermissionTo($permission);
                $perm = Permission::findByName($permission, $guardName);
                $perm->delete();
            }



//            /** Start Permissions Variable **/
//
//            $permission = DB::select("select name from permissions where guard_name = '$guardName'");
//

//            $role->detach();

//            /** End Permissions Variable **/
//
//
//            $permissionsArray = [];
//
//            foreach($permissions as $permission) {
//                $permissionsArray[] = $permission->name;
//            }

//            /** Create New Permissions. **/
//            foreach($request->except("_token") as $permission) {
//
////                if(! in_array($permission, $permissionsArray)) {
//
//                    Permission::Create(["name" => $permission, "guard_name" => $guardName]);
//
////                }
//
//            }

            $newPermissions = $request->except(["_token", "guard", "permissions"]);
            $permissions = [];

            /** Create New Permissions. **/
            foreach($newPermissions as $permission) {

                Permission::create(['guard_name' => $guardName, 'name' => $permission]);

                $permissions[] = $permission;


            }

            /** Give The New Permissions ($permissions) To The New Role ($role). **/
            $role->syncPermissions($permissions);

            return redirect()->route("permissions.index");
        }

        /** End update Method **/


                        /******************************************************************************/

        /**
         * Remove the specified resource from storage.
         * @param int $id
         * @return Renderable
         */
        public function destroy(int $id)
        {
            $role = DB::select("select guard_name from roles where id = $id");

            $guardName = $role[0]->guard_name;

            $permissions = DB::select("select name from permissions where guard_name = '$guardName'");

            foreach($permissions as $permission) {
                $perm = Permission::findByName($permission->name, $guardName);
                $perm->delete();
            }

            $roleForDelete = Role::findById($id, $guardName);
            $roleForDelete->delete();

            return redirect()->route("permissions.index");
        }
    }

/** End The PermissionsSettingsController **/
