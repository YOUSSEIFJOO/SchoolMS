<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\StudentsAttendance\Http\Controllers;

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


/** Start Model Of Student Attendance Declaration **/

    use Modules\StudentsAttendance\Entities\StudentAttendance;

/** End Model Of Student Attendance Declaration **/

/** Start Model Of Student Declaration **/

    use Modules\Students\Entities\Student;

/** End Model Of Student Declaration **/


/** Start Model Of ClassAcademic Declaration **/

    use Modules\ClassAcademic\Entities\ClassAcademic;

/** End Model Of ClassAcademic Declaration **/


/** Start Model Of SectionAcademic Declaration **/

    use Modules\SectionAcademic\Entities\SectionAcademic;

/** End Model Of SectionAcademic Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The StudentsAttendanceController **/

    class StudentsAttendanceController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of StudentAttendance Model. **/
            private $studentAttendance;

            /** For Declaring Instance Of StudentAttendance Model. **/
            private $student;

            /** For Declaring Instance Of ClassAcademic Model. **/
            private $classAcademic;

            /** For Declaring Instance Of SectionAcademic Model. **/
            private $sectionAcademic;

            /** For Declaring Some Properties Will Selected From Class Academic **/
            private $selectProperties;

            /** For Declaring Query Of Class Academic. **/
            private $classes;

        /** End Declaration Properties Of This Controller **/


                        /******************************************************************************/

        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Student Attendance Model. **/
                $this->studentAttendance = new StudentAttendance;

                /** For Declaring Instance Of Student Model. **/
                $this->student = new Student;

                /** For Declaring Instance Of ClassAcademic Model. **/
                $this->classAcademic = new ClassAcademic;

                /** For Declaring Instance Of SectionAcademic Model. **/
                $this->sectionAcademic = new SectionAcademic;

                /** This Array To Put In It The Properties That You Want To Select It For Show All Classes. **/
                $this->selectProperties = ["id", "name"];

                /** Select Some Properties From ClassAcademic Table **/
                $this->classes = AppHelper::selectProperty($this->classAcademic, $this->selectProperties);
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
                        $selectProperties = ["id", "name", "class_id_students", "section_id_students", "date", "status"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["class_id_students", "section_id_students", "name", "date"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $attendance = AppHelper::QuerySearch($this->studentAttendance, $selectProperties, "date", "desc", $request, $whereProperties);

                    /** End $attendance Variable **/


                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $sections Variable **/

                        /** Select Some Properties From SectionAcademic Table **/
                        $sections = AppHelper::selectProperty($this->sectionAcademic, $this->selectProperties);

                    /** End $sections Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Students Attendance With Variables **/
                        return view('studentsattendance::index',
                            compact("attendance", "paginationNumber", "classes", "sections"))
                            ->with("instanceClass", $this->classAcademic)
                            ->with("instanceSection", $this->sectionAcademic);

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("studentsAttendance.index");

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

                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $checkAttendance Variable **/

                        /** Check If Students Attendance Take Before Or Not. **/
                        $checkAttendance = AppHelper::checkAttendance($this->studentAttendance, $request, ["class_id_students", "section_id_students", "date"]);

                    /** End $checkAttendance Variable **/


                    /** Start $students Variable **/

                        /** Get Records Related To Values From Search Inputs. **/
                        $students = AppHelper::QuerySearchCreate($this->student, $request, ["class_id_students", "section_id_students"]);

                    /** End $students Variable **/


                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Students Attendance With Variables **/
                        return view('studentsattendance::create', compact("students", "checkAttendance", "classes"));

                    /** End Return To Create View **/


                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("studentsAttendance.index");

                }
            }

        /** End create Method **/


                        /******************************************************************************/


        /** Start selectSection Method **/

            /**
             * Get Related Sections When I Press On Class Select Box In Create View Of Students Attendance.
             * @param Request $request
             * @return RedirectResponse
             */
            public function selectSection(Request $request)
            {

                try {

                    /** Start Return Response To Create View **/

                    /** Return Response To Create View Of Students Attendance That Get The Related Sections Of Class Pressed. **/
                    return json_decode($this->sectionAcademic->where("class_id", $request->class_id)->get());

                    /** End Return Response To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("studentsAttendance.index");

                }

            }

        /** End selectSection Method **/


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

                        /** This Function For Handel Request Arrays Of Student Attendance. **/
                        $data = AppHelper::HandelRequestArrays($request);

                    /** End $data Variable **/

                    /** Start Create The Data Of New Students Attendance **/

                        /** Create New Students Attendance. **/
                        StudentAttendance::insert($data);

                    /** End Create The Data Of New Student Attendance **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Students Attendance Has Been Created Successfully **/
                        return AppHelper::IfSuccessfully('Students Attendance Created Successfully', "studentsAttendance.index");

                    /** End Return To Index View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students Attendance And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("studentsAttendance.index");

                }
            }

        /** End store Method **/
    }

/** End The StudentsAttendanceController **/
