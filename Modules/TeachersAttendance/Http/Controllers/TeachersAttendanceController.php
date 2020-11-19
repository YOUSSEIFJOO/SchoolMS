<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\TeachersAttendance\Http\Controllers;

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


/** Start Model Of Teacher Attendance Declaration **/

    use Modules\TeachersAttendance\Entities\TeacherAttendance;

/** End Model Of Teacher Attendance Declaration **/


/** Start Model Of Teacher Declaration **/

    use Modules\Teachers\Entities\Teacher;

/** End Model Of Teacher Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The TeachersAttendanceController **/

    class TeachersAttendanceController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of TeacherAttendance Model. **/
            private $teacherAttendance;

            /** For Declaring Instance Of TeacherAttendance Model. **/
            private $teacher;

        /** End Declaration Properties Of This Controller **/


                        /******************************************************************************/


        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Teacher Attendance Model. **/
                $this->teacherAttendance = new TeacherAttendance;

                /** For Declaring Instance Of Teacher Model. **/
                $this->teacher = new Teacher;

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
                        $attendance = AppHelper::QuerySearch($this->teacherAttendance, $selectProperties, "date", "desc", $request, $whereProperties);

                    /** End $attendance Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Teachers Attendance With Variables **/
                        return view('teachersAttendance::index', compact("attendance", "paginationNumber"));

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachersAttendance.index");

                }
            }

        /** End Index Method **/


                        /******************************************************************************/


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

                        /** Check If Teachers Attendance Take Before Or Not. **/
                        $checkAttendance = AppHelper::checkAttendance($this->teacherAttendance, $request, ["name", "date"]);

                    /** End $checkAttendance Variable **/


                    /** Start $teachers Variable **/

                        /** Get Teacher Names For Display In Select Box In Create View. **/
                        $teachersNameSearch = AppHelper::selectProperty($this->teacher, "name");

                    /** End $teachers Variable **/


                    /** Start $teachers Variable **/

                        /** Get Records Related To Values From Search Inputs. **/
                        $teachers = AppHelper::selectPropertiesWithWhere($this->teacher, ["id", "name", "designation"], "name", $request->name);

                    /** End $teachers Variable **/


                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Teachers Attendance With Variables **/
                        return view('teachersAttendance::create', compact("teachersNameSearch", "teachers", "checkAttendance"));

                    /** End Return To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachersAttendance.index");

                }
            }

        /** End create Method **/


                        /******************************************************************************/


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


                    /** Start Create The Data Of New Teacher Attendance **/

                        /** Create New Teacher Attendance. **/
                        TeacherAttendance::create($data);

                    /** End Create The Data Of New Teacher Attendance **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Teacher Attendance Has Been Created Successfully **/
                        return AppHelper::IfSuccessfully('Teacher Attendance Created Successfully', "teachersAttendance.index");

                    /** End Return To Index View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachersAttendance.index");

                }

            }

        /** End store Method **/

    }

/** End The TeachersAttendanceController **/
