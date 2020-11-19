<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\EmployeesAttendance\Http\Controllers;

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
    use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start Model Of Employee Attendance Declaration **/

    use Modules\EmployeesAttendance\Entities\EmployeeAttendance;

/** End Model Of Employee Attendance Declaration **/


/** Start Model Of Employee Declaration **/

    use Modules\Employees\Entities\Employee;

/** End Model Of Employee Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The EmployeesAttendanceController **/

    class EmployeesAttendanceController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of TeacherAttendance Model. **/
            private $employeeAttendance;

            /** For Declaring Instance Of TeacherAttendance Model. **/
            private $employee;

        /** End Declaration Properties Of This Controller **/


                        /******************************************************************************/


        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Employee Attendance Model. **/
                $this->employeeAttendance = new EmployeeAttendance;

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


                    /** Start $attendance Variable **/

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name", "designation", "date", "status"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["name", "designation", "date"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $attendance = AppHelper::QuerySearch($this->employeeAttendance, $selectProperties, "date", "desc", $request, $whereProperties);

                    /** End $attendance Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Employees Attendance With Variables **/
                        return view('employeesAttendance::index', compact("attendance", "paginationNumber"));

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Employees Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("employeesAttendance.index");

                }
            }

        /** End Index Method **/


        /** Start create Method **/

            /**
             * Show the form for creating a new resource.
             * @param Request $request
             * @return Application|Factory|RedirectResponse|View
             */
            public function create(Request $request)
            {
                try {

                    /** Start $checkAttendance Variable **/

                        /** Check If Employees Attendance Take Before Or Not. **/
                        $checkAttendance = AppHelper::checkAttendance($this->employeeAttendance, $request, ["name", "date"]);

                    /** End $checkAttendance Variable **/


                    /** Start $teachers Variable **/

                        /** Get Employees Names For Display In Select Box In Create View. **/
                        $employeesNameSearch = AppHelper::selectProperty($this->employee, "name");

                    /** End $teachers Variable **/


                    /** Start $teachers Variable **/

                        /** Get Records Related To Values From Search Inputs. **/
                        $employees = AppHelper::selectPropertiesWithWhere($this->employee, ["id", "name", "designation"], "name", $request->name);

                    /** End $teachers Variable **/


                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Employees Attendance With Variables **/
                        return view('employeesAttendance::create', compact("employeesNameSearch", "employees", "checkAttendance"));

                    /** End Return To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Employees Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("employeesAttendance.index");

                }
            }

        /** End create Method **/


        /** Start store Method **/

            /**
             * Store a newly created resource in storage.
             * @param Request $request
             * @return RedirectResponse
             */
            public function store(Request $request)
            {
                try {

                    /** Start $data Variable **/

                        /** This Function For Handel All Requests Except _token. **/
                        $data = $request->except("_token");

                    /** End $data Variable **/


                    /** Start Create The Data Of New Employee Attendance **/

                        /** Create New Teacher Attendance. **/
                        EmployeeAttendance::create($data);

                    /** End Create The Data Of New Employee Attendance **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Teacher Attendance Has Been Created Successfully **/
                        return AppHelper::IfSuccessfully('Employee Attendance Created Successfully', "employeesAttendance.index");

                    /** End Return To Index View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Employees Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("employeesAttendance.index");

                }

            }

        /** End store Method **/
    }

/** End The EmployeesAttendanceController **/
