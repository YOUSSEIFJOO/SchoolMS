<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\Students\Http\Controllers;

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

    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start Model Of Student Declaration **/

    use Modules\Students\Entities\Student;

/** End Model Of Student Declaration **/


/** Start Model Of ClassAcademic Declaration **/

    use Modules\ClassAcademic\Entities\ClassAcademic;

/** End Model Of ClassAcademic Declaration **/


/** Start Model Of SectionAcademic Declaration **/

    use Modules\SectionAcademic\Entities\SectionAcademic;

/** End Model Of SectionAcademic Declaration **/


/** Start Student Request Declaration **/

    use Modules\Students\Http\Requests\StudentRequest;

/** End Student Request Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The StudentsController **/

    class StudentsController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of Student Model. **/
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


                    /** Start Students Variable **/

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name", "fatherName", "class_id_students", "section_id_students"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["class_id_students", "section_id_students", "name"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $students = AppHelper::QuerySearch($this->student, $selectProperties, "class_id_students", "desc", $request, $whereProperties);

                    /** End Students Variable **/


                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $sections Variable **/

                        /** Select Some Properties From SectionAcademic Table **/
                        $sections = AppHelper::selectProperty($this->sectionAcademic, $this->selectProperties);

                    /** End $sections Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Students With Variables **/
                        return view('students::index',
                               compact("students", "paginationNumber", "classes", "sections"))
                               ->with("instanceClass", $this->classAcademic)
                               ->with("instanceSection", $this->sectionAcademic);

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

                }
            }

        /** End Index Method **/


                        /******************************************************************************/


        /** Start selectSection Method **/

            /**
             * Get Related Sections When I Press On Class Select Box In Create View Of Students.
             * @param Request $request
             * @return RedirectResponse
             */
            public function selectSection(Request $request)
            {

                try {

                    /** Start Return Response To Create View **/

                        /** Return Response To Create View Of Students That Get The Related Sections Of Class Pressed. **/
                        return json_decode($this->sectionAcademic->where("class_id", $request->class_id)->get());

                    /** End Return Response To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

                }

            }

        /** End selectSection Method **/


                        /******************************************************************************/


        /** Start create Method **/

            /**
             * Show the form for creating a new resource.
             * @return Application|Factory|RedirectResponse|View
             */
            public function create()
            {
                try {

                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Students With Variables **/
                        return view('students::create', compact("classes"));

                    /** End Return To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

                }
            }

        /** End create Method **/


                        /******************************************************************************/


        /** Start store Method **/

            /**
             * Store a newly created resource in storage.
             * @param StudentRequest $request
             * @return RedirectResponse
             */
            public function store(StudentRequest $request)
            {
                try{

                    /** Start $className Variable **/

                        /** Get THe Class Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id_students);

                    /** End $className Variable **/


                    /** Start $sectionName Variable **/

                        /** Get THe Section Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $sectionName = AppHelper::selectPropertyWithWhere($this->sectionAcademic, "name", "id", $request->section_id_students);

                    /** End $sectionName Variable **/


                    /** Start $countStudents Variable **/

                        /** Count Rows From Student Table Where section_id === $request->section_id **/
                        $countStudents = AppHelper::countRow($this->student, "section_id_students", $request->section_id_students);

                    /** End $countStudents Variable **/


                    /** Start $capacitySections Variable **/

                        /** Get The Capacity Students For Check With Count Of Students From Section Academic. **/
                        $capacitySections = AppHelper::selectPropertyWithWhere($this->sectionAcademic,"capacity_students","id", $request->section_id_students);

                    /** End $capacitySections Variable **/


                    /** Start If State For Check Capacity **/

                        /** Check If Count Of Students In A Section Is Less Or Equal Or Greater Than Capacity In Section Academic **/
                        if($countStudents >= $capacitySections) {

                            /** If True Not Store This Student But Redirect Back With Nice Message Disappear The Error. **/
                            return Redirect::back()->with("noCapacity", "Sorry You Can't Add $request->name Student To $className Class And $sectionName Section. Try To Change The Class Or Section");

                        } else {

                            /** If False Store This New Student. **/


                            /** Start $data Variable **/

                                /**
                                 ** Preparation Data Of New Student To Store In DB.
                                 ** Excepting _token, photo, time.
                                 ** _token By Default Don't Save In DB.
                                 ** photo Except In First For Store It In Server With Hash Name And Add It To $data.
                                 ** time Except In First For Creating Unique Folder From Milliseconds Of Time For Storing Photo In Them Then Add To $data.
                                 ** students Disk For Store Photo That Belongs To Students Only.
                                 **/
                                $data = AppHelper::StorePhotoIfFound($request, ["_token", "photo"], "students");

                            /** End $data Variable **/


                            /** Start Create The Data Of New Student **/

                                /** Create Data Of New Student If $data Ready To Store In DB. **/
                                Student::create($data);

                            /** End Create The Data Of New Student **/


                            /** Start Return To Index View **/

                                /** Redirect To Index View If Student Has Been Created Successfully **/
                                return AppHelper::IfSuccessfully('Student Created Successfully', "students.index");

                            /** End Return To Index View **/

                        }

                    /** End If State For Check Capacity **/


                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

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

                    /** Check Founding Id For Show Data Of A Student **/
                    return AppHelper::CheckFoundingId(
                        $this->student,
                        $id,
                        "This Student Is Not Found",
                        "students.index",
                        "students::show",
                        "student",
                        $this->classAcademic,
                        $this->sectionAcademic
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

                }
            }

        /** End show Method **/


                        /******************************************************************************/


        /** Start Edit Method **/

            /**
             * Show the form for editing the specified resource.
             * @param $id
             * @return Factory|RedirectResponse|View
             */
            public function edit($id)
            {
                try {

                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $section Variable **/

                        /** Get The Class ID From Student According To $id **/
                        $classID = AppHelper::selectPropertyWithWhere($this->student, "class_id_students", "id", $id);

                        /** Get The Section By $classID From Student According To $id **/
                        $sections = AppHelper::selectPropertiesWithWhere($this->sectionAcademic, $this->selectProperties, "class_id", $classID);

                    /** End $section Variable **/


                    /** Check Founding Id For Edit Data Of A Student **/
                    return AppHelper::CheckFoundingId(
                        $this->student,
                        $id,
                        "This Student Not Found",
                        "students.index",
                        "students::edit",
                        "student",
                        null,
                        null,
                        null,
                        $classes,
                        $sections
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

                }
            }

        /** End Edit Method **/


                        /******************************************************************************/


        /** Start Update Method **/

            /**
             * Update the specified resource in storage.
             * @param StudentRequest $request
             * @param $id
             * @return RedirectResponse
             */
            public function update(StudentRequest $request, $id)
            {
                try {

                    /** Start $student Variable **/

                        /** Find The Student With $id. **/
                        $student = AppHelper::FoundWithId($this->student, $id);

                    /** End $student Variable **/


                    /** Check If $id Not Found. **/
                    if (!$student) {

                        /** If True ($id Not Found) **/

                        /** Redirect To View Index With Error Message **/
                        return AppHelper::IfNotFound('This Student Not Found', "students.index");

                    }

                    /** If False ($id Founded) **/


                    /** Start $className Variable **/

                        /** Get THe Class Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id_students);

                    /** End $className Variable **/


                    /** Start $sectionName Variable **/

                        /** Get THe Section Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $sectionName = AppHelper::selectPropertyWithWhere($this->sectionAcademic, "name", "id", $request->section_id_students);

                    /** End $sectionName Variable **/


                    /** Start $countStudents Variable **/

                        /** Count Rows From Student Table Where section_id === $request->section_id **/
                        $countStudents = AppHelper::countRow($this->student, "section_id_students", $request->section_id_students);

                    /** End $countStudents Variable **/


                    /** Start $capacitySections Variable **/

                        /** Get The Capacity Students For Check With Count Of Students From Section Academic. **/
                        $capacitySections = AppHelper::selectPropertyWithWhere($this->sectionAcademic,"capacity_students","id", $request->section_id_students);

                    /** End $capacitySections Variable **/


                    /** Start $foundClass Variable **/

                        /** For Check If Class Has Changed Or Not For Check Capacity **/
                        $foundClass = AppHelper::selectPropertyWithWhere($this->student, "class_id_students", "id", $id);

                        /** For Check If Section Has Changed Or Not For Check Capacity **/
                        $foundSection = AppHelper::selectPropertyWithWhere($this->student, "section_id_students", "id", $id);

                    /** End $foundClass Variable **/


                    if($foundClass == $request->class_id_students && $foundSection == $request->section_id_students) {

                        /** Start $data Variable **/

                        /**
                         ** Preparation Data Of New Student To Store In DB.
                         ** Excepting _token, photo, time.
                         ** _token By Default Don't Save In DB.
                         ** photo Except In First For Store It In Server With Hash Name And Add It To $data.
                         ** time Except In First For Creating Unique Folder From Milliseconds Of Time For Storing Photo In Them Then Add To $data.
                         ** students Disk For Store Photo That Belongs To Students Only.
                         **/
                        $data = AppHelper::DeleteStorePhotoIfFound($this->student, $id, $request, ["_token", "photo"], "students", "students");

                        /** End $data Variable **/


                        /** Start Update The Data Of The Student **/

                        /** Update Data Of The If $data Ready To Update In DB. **/
                        $student->update($data);

                        /** End Update The Data Of The Student **/


                        /** Start Return To Index View **/

                        /** Redirect To Index View If Student Has Been Updated Successfully **/
                        return AppHelper::IfSuccessfully('The Data Of Student Updated Successfully', "students.index");

                        /** End Return To Index View **/

                    } else {

                        if($countStudents >= $capacitySections) {

                            /** If True Not Store This Student But Redirect Back With Nice Message Disappear The Error. **/
                            return Redirect::back()->with("noCapacity", "Sorry You Can't Update $request->name Student To $className Class And $sectionName Section. Try To Change The Class Or Section");

                        } else {

                            /** Start $data Variable **/

                            /**
                             ** Preparation Data Of New Student To Store In DB.
                             ** Excepting _token, photo, time.
                             ** _token By Default Don't Save In DB.
                             ** photo Except In First For Store It In Server With Hash Name And Add It To $data.
                             ** time Except In First For Creating Unique Folder From Milliseconds Of Time For Storing Photo In Them Then Add To $data.
                             ** students Disk For Store Photo That Belongs To Students Only.
                             **/
                            $data = AppHelper::DeleteStorePhotoIfFound($this->student, $id, $request, ["_token", "photo"], "students", "students");

                            /** End $data Variable **/


                            /** Start Update The Data Of The Student **/

                            /** Update Data Of The If $data Ready To Update In DB. **/
                            $student->update($data);

                            /** End Update The Data Of The Student **/


                            /** Start Return To Index View **/

                            /** Redirect To Index View If Student Has Been Updated Successfully **/
                            return AppHelper::IfSuccessfully('The Data Of Student Updated Successfully', "students.index");

                            /** End Return To Index View **/

                        }

                    }

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

                }
            }

        /** End Update Method **/


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

                    /** Start $student Variable **/

                        /** Find The Student With $id. **/
                        $student = AppHelper::FoundWithId($this->student, $id);

                    /** End $student Variable **/


                        /** Check If $id Not Found. **/
                        if (!$student) {

                            /** If True ($id Not Found) **/

                            /** Redirect To View Index With Error Message **/
                            return AppHelper::IfNotFound('This Student Not Found', "students.index");

                        }


                    /** If False ($id Founded) **/


                    /** Start $file Variable **/

                        /** Get The Path Folder Of Photo Of This Student. **/
                        $file = public_path() . "\images\students\\" . $student->photo;

                    /** End $file Variable **/


                    /** Start Delete The Folder Of Photo **/

                        /** Delete The Folder Of Photo For This Student. **/
                        File::delete($file);

                    /** End Delete The Folder Of Photo **/


                    /** Start Delete The Student **/

                        /** Delete This Student. **/
                        $student->delete();

                    /** End Delete The Student **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Student Has Been Deleted Successfully **/
                        return AppHelper::IfSuccessfully('The Student Deleted Successfully', "students.index");

                    /** End Return To Index View **/


                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Students And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("students.index");

                }
            }

        /** End Destroy Method **/

    }

/** End The StudentsController **/
