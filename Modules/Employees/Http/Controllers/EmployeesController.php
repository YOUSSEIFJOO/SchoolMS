<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\Employees\Http\Controllers;

/** End The NameSpace Of This Controller **/


/** Start Basic Declaration **/

    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Routing\Controller;
    use Illuminate\Http\Request;
    use Exception;

/** End Basic Declaration **/


/** Start Redirect Of Response Declaration **/

    use Illuminate\Http\RedirectResponse;

/** End Redirect Of Response Declaration **/


/** Start View Helper Declaration **/

    use Illuminate\Contracts\View\Factory;
    use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start Model Of Employee Declaration **/

    use Modules\Employees\Entities\Employee;

/** End Model Of Student Declaration **/


/** Start Student Request Declaration **/

    use Modules\Employees\Http\Requests\EmployeeRequest;

/** End Student Request Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                    /******************************************************************************/


/** Start The EmployeesController **/

    class EmployeesController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of Student Model. **/
            private $employee;

        /** End Declaration Properties Of This Controller **/


                        /******************************************************************************/


        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Employee Model. **/
                $this->employee = new Employee;

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


                    /** Start Students Variable **/

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name", "designation"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["name", "designation"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $employees = AppHelper::QuerySearch($this->employee, $selectProperties, "name", "desc", $request, $whereProperties);

                    /** End Students Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Students With Variables **/
                        return view('employees::index', compact("employees", "paginationNumber"));

                    /** End Return To Index View **/


                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Employees And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("employees.index");

                }
            }

        /** End Index Method **/


                        /******************************************************************************/


        /** Start create Method **/

            /**
             * Show the form for creating a new resource.
             * @return Application|Factory|RedirectResponse|View
             */
            public function create()
            {
                try {

                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Employees With Variables **/
                        return view('employees::create');

                    /** End Return To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Employees And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("employees.index");

                }
            }

        /** End create Method **/


                        /******************************************************************************/


        /** Start store Method **/

            /**
             * Store a newly created resource in storage.
             * @param EmployeeRequest $request
             * @return RedirectResponse
             */
            public function store(EmployeeRequest $request)
        {
            try{

                /** Start $data Variable **/

                    /**
                     ** Preparation Data Of New Employee To Store In DB.
                     ** Excepting _token, photo, time.
                     ** _token By Default Don't Save In DB.
                     ** photo Except In First For Store It In Server With Hash Name And Add It To $data.
                     ** time Except In First For Creating Unique Folder From Milliseconds Of Time For Storing Photo In Them Then Add To $data.
                     ** students Disk For Store Photo That Belongs To Students Only.
                     **/
                    $data = AppHelper::StorePhotoIfFound($request, ["_token", "photo"], "employees");

                /** End $data Variable **/


                /** Start Create The Data Of New Employee **/

                    /** Create Data Of New Employee If $data Ready To Store In DB. **/
                    Employee::create($data);

                /** End Create The Data Of New Employee **/


                /** Start Return To Index View **/

                    /** Redirect To Index View If Employee Has Been Created Successfully **/
                    return AppHelper::IfSuccessfully('Employee Created Successfully', "employees.index");

                /** End Return To Index View **/

            } catch(Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Employees And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("employees.index");

            }
        }

        /** End store Method **/


                        /******************************************************************************/


        /** Start show Method **/

            /**
             * Show the specified resource.
             * @param $id
             * @return RedirectResponse
             */
            public function show($id)
            {
                try {

                    /** Check Founding Id For Show Data Of A Employee **/
                    return AppHelper::CheckFoundingId(
                        $this->employee,
                        $id,
                        "This Employee Is Not Found",
                        "employees.index",
                        "employees::show",
                        "employee"
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Employees And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("employees.index");

                }
            }

        /** End show Method **/


                        /******************************************************************************/


        /** Start Edit Method **/

            /**
             * Show the form for editing the specified resource.
             * @param $id
             * @return RedirectResponse
             */
            public function edit($id)
        {
            try {

                /** Check Founding Id For Edit Data Of A Employee **/
                return AppHelper::CheckFoundingId(
                    $this->employee,
                    $id,
                    "This Employee Is Not Found",
                    "employees.index",
                    "employees::edit",
                    "employee"
                );

            } catch(Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Employees And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("employees.index");

            }
        }

        /** End Edit Method **/


                        /******************************************************************************/


        /** Start update Method **/

            /**
             * Update the specified resource in storage.
             * @param EmployeeRequest $request
             * @param $id
             * @return RedirectResponse
             */
            public function update(EmployeeRequest $request, $id)
        {
            try {

                /** Start $employee Variable **/

                    /** Find The Employee With $id. **/
                    $employee = AppHelper::FoundWithId($this->employee, $id);

                /** End $employee Variable **/


                /** Check If $id Not Found. **/
                if (!$employee) {

                    /** If True ($id Not Found) **/

                    /** Redirect To View Index With Error Message **/
                    return AppHelper::IfNotFound('This Employee Not Found', "employees.index");

                }

                /** If False ($id Founded) **/


                /** Start $data Variable **/

                    /**
                     ** Preparation Data Of New Employee To Store In DB.
                     ** Excepting _token, photo, time.
                     ** _token By Default Don't Save In DB.
                     ** photo Except In First For Store It In Server With Hash Name And Add It To $data.
                     ** time Except In First For Creating Unique Folder From Milliseconds Of Time For Storing Photo In Them Then Add To $data.
                     ** Employees Disk For Store Photo That Belongs To Employee Only.
                     **/
                    $data = AppHelper::DeleteStorePhotoIfFound($this->employee, $id, $request, ["_token", "photo"], "employees", "employees");

                /** End $data Variable **/


                /** Start Update The Data Of The Employee **/

                    /** Update Data Of The If $data Ready To Update In DB. **/
                    $employee->update($data);

                /** End Update The Data Of The Employee **/


                /** Start Return To Index View **/

                    /** Redirect To Index View If Employee Has Been Updated Successfully **/
                    return AppHelper::IfSuccessfully('The Data Of Employee Updated Successfully', "employees.index");

                /** End Return To Index View **/

            } catch(Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Employees And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("employees.index");

            }
        }

        /** End update Method **/


                        /******************************************************************************/


        /** Start Destroy Method **/

            /**
             * Remove the specified resource from storage.
             * @param $id
             * @return RedirectResponse
             */
            public function destroy($id)
        {
            try {

                /** Start $employee Variable **/

                    /** Find The Employee With $id. **/
                    $employee = AppHelper::FoundWithId($this->employee, $id);

                /** End $employee Variable **/


                /** Check If $id Not Found. **/
                if (!$employee) {

                    /** If True ($id Not Found) **/

                    /** Redirect To View Index With Error Message **/
                    return AppHelper::IfNotFound('This Employee Not Found', "employees.index");

                }

                /** If False ($id Founded) **/


                /** Start $file Variable **/

                    /** Get The Path Folder Of Photo Of This Employee. **/
                    $file = public_path() . "\images\\employees\\" . $employee->photo;

                /** End $file Variable **/


                /** Start Delete The Folder Of Photo **/

                    /** Delete The Folder Of Photo For This Employee. **/
                    File::delete($file);

                /** End Delete The Folder Of Photo **/


                /** Start Delete The Employee **/

                    /** Delete This Employee. **/
                    $employee->delete();

                /** End Delete The Employee **/


                /** Start Return To Index View **/

                    /** Redirect To Index View If Employee Has Been Deleted Successfully **/
                    return AppHelper::IfSuccessfully('The Employee Deleted Successfully', "employees.index");

                /** End Return To Index View **/

            } catch(Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Employees And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("employees.index");

            }
        }

        /** End Destroy Method **/
    }

/** End The EmployeesController **/
