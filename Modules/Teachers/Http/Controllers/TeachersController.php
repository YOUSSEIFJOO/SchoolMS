<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\Teachers\Http\Controllers;

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


/** Start Model Of Teacher Declaration **/

    use Modules\Teachers\Entities\Teacher;

/** End Model Of Teacher Declaration **/


/** Start Model Of ClassAcademic Declaration **/

    use Modules\ClassAcademic\Entities\ClassAcademic;

/** End Model Of ClassAcademic Declaration **/


/** Start Model Of SectionAcademic Declaration **/

    use Modules\SectionAcademic\Entities\SectionAcademic;

/** End Model Of SectionAcademic Declaration **/


/** Start Model Of SubjectAcademic Declaration **/

    use Modules\SubjectAcademic\Entities\SubjectAcademic;

/** End Model Of SubjectAcademic Declaration **/


/** Start Student Request Declaration **/

    use Modules\Teachers\Http\Requests\TeacherRequest;

/** End Student Request Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                    /******************************************************************************/


/** Start The TeachersController **/

    class TeachersController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of Teacher Model. **/
            private $teacher;

            /** For Declaring Instance Of ClassAcademic Model. **/
            private $classAcademic;

            /** For Declaring Instance Of SectionAcademic Model. **/
            private $sectionAcademic;

            /** For Declaring Instance Of SubjectAcademic Model. **/
            private $subjectAcademic;

            /** For Declaring Some Properties Will Selected From Class Academic **/
            private $selectProperties;

            /** For Declaring Query Of Class Academic. **/
            private $classes;

        /** End Declaration Properties Of This Controller **/


                        /******************************************************************************/


        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Teacher Model. **/
                $this->teacher = new Teacher;

                /** For Declaring Instance Of ClassAcademic Model. **/
                $this->classAcademic = new ClassAcademic;

                /** For Declaring Instance Of SectionAcademic Model. **/
                $this->sectionAcademic = new SectionAcademic;

                /** For Declaring Instance Of SubjectAcademic Model. **/
                $this->subjectAcademic = new SubjectAcademic;

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


                    /** Start Teachers Variable **/

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name", "class_id_teachers", "section_id_teachers", "designation"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["class_id_teachers", "section_id_teachers", "name", "designation"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $teachers = AppHelper::QuerySearch($this->teacher, $selectProperties, "name", "desc", $request, $whereProperties);

                    /** End Teachers Variable **/


                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $sections Variable **/

                        /** Select Some Properties From SectionAcademic Table **/
                        $sections = AppHelper::selectProperty($this->sectionAcademic, $this->selectProperties);

                    /** End $sections Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Teachers With Variables **/
                        return view('teachers::index',
                               compact("teachers", "paginationNumber", "classes", "sections"))
                               ->with("instanceClass", $this->classAcademic)
                               ->with("instanceSection", $this->sectionAcademic);

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }
            }

        /** End Index Method **/


                        /******************************************************************************/


        /** Start selectSection Method **/

            /**
             * Get Related Sections When I Press On Class Select Box In Create View Of Teachers.
             * @param Request $request
             * @return RedirectResponse
             */
            public function selectSection(Request $request){

                try {

                    /** Start Return Response To Create View **/

                        /** Return Response To Create View Of Students That Get The Related Sections Of Class Pressed. **/
                        return json_decode($this->sectionAcademic->where("class_id", $request->class_id)->get());

                    /** End Return Response To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }

            }

        /** End selectSection Method **/


                        /******************************************************************************/


        /** Start selectSubject Method **/

            /**
             * Get Related Subjects When I Press On Class Select Box In Create View Of Teachers.
             * @param Request $request
             * @return RedirectResponse
             */
            public function selectSubject(Request $request){

                try {

                    /** Start Return Response To Create View **/

                        /** Get ID Of Class From Section ID From Sections In Select Box In Create View Of Teachers. **/
                        $classID = SectionAcademic::select("class_id")->where("id", $request->section_id)->first();

                        /** Return Response To Create View Of Students That Get The Related Sections Of Class Pressed. **/
                        return json_decode($this->subjectAcademic->where("class_id", $classID->class_id)->get());

                    /** End Return Response To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }

            }

        /** End selectSubject Method **/


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

                        /** Select Some Properties From ClassAcademic Table. **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Teachers With Variables. **/
                        return view('teachers::create', compact("classes"));

                    /** End Return To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }
            }

        /** End create Method **/


                        /******************************************************************************/


        /** Start store Method **/

            /**
             * Store a newly created resource in storage.
             * @param TeacherRequest $request
             * @return RedirectResponse
             */
            public function store(TeacherRequest $request)
            {
                try{

                    /** Start $className Variable **/

                        /** Get THe Class Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id_teachers);

                    /** End $className Variable **/


                    /** Start $sectionName Variable **/

                        /** Get THe Section Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $sectionName = AppHelper::selectPropertyWithWhere($this->sectionAcademic, "name", "id", $request->section_id_teachers);

                    /** End $sectionName Variable **/


                    /** Start $sectionName Variable **/

                        /** Get THe Subject Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $subjectName = AppHelper::selectPropertyWithWhere($this->subjectAcademic, "name", "id", $request->subject_id_teachers);

                    /** End $sectionName Variable **/


                    /** Start $checkFounding Variable **/

                        /** Properties For Checking Of Values Of Requests Are In DB Or Not **/
                        $whereProperties = ["class_id_teachers", "section_id_teachers", "subject_id_teachers"];

                        /** Make Query Where On Teacher Table. **/
                        $checkFounding = AppHelper::checkFoundingForNotSaving($this->teacher, $request, $whereProperties);

                    /** End $checkFounding Variable **/


                    /** Start Checking **/
                    if($checkFounding > 0) {

                        /** If True (Values Founded In DB) **/

                        /** Return Redirect Back To Create View Of Teacher With Nice Message Appear The Error **/
                        return Redirect::back()->with("noCapacity", "Sorry You Can't Add $request->name Teacher To $className Class And $sectionName Section With $subjectName Subject.");


                    } else {

                        /** If False (Values Didn't Found In DB) **/


                        /** Start $data Variable **/

                            /**
                             ** Preparation Data Of New Teacher To Store In DB.
                             ** Excepting _token, photo, time.
                             ** _token By Default Don't Save In DB.
                             ** photo Except In First For Store It In Server With Hash Name And Add It To $data.
                             ** time Except In First For Creating Unique Folder From Milliseconds Of Time For Storing Photo In Them Then Add To $data.
                             ** students Disk For Store Photo That Belongs To Teachers Only.
                             **/
                            $data = AppHelper::StorePhotoIfFound($request, ["_token", "photo"], "teachers");

                        /** End $data Variable **/


                        /** Start Create The Data Of New Teacher **/

                            /** Create Data Of New Teacher If $data Ready To Store In DB. **/
                            Teacher::create($data);

                        /** End Create The Data Of New Teacher **/


                        /** Start Return To Index View **/

                            /** Redirect To Index View If Teacher Has Been Created Successfully **/
                            return AppHelper::IfSuccessfully('Teacher Created Successfully', "teachers.index");

                        /** End Return To Index View **/

                    }


                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

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
                        $this->teacher,
                        $id,
                        "This Teacher Is Not Found",
                        "teachers.index",
                        "teachers::show",
                        "teacher",
                        $this->classAcademic,
                        $this->sectionAcademic,
                        $this->subjectAcademic
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }
            }

        /** End show Method **/


                        /******************************************************************************/


        /** Start edit Method **/

            /**
             * Show the form for editing the specified resource.
             * @param $id
             * @return RedirectResponse
             */
            public function edit($id)
            {
                try {

                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $classID Variable **/

                        /** Get The Class ID From Student According To $id **/
                        $classID = AppHelper::selectPropertyWithWhere($this->teacher, "class_id_teachers", "id", $id);

                    /** Start $classID Variable **/


                    /** Start $section Variable **/

                        /** Get The Section By $classID From Student According To $id **/
                        $sections = AppHelper::selectPropertiesWithWhere($this->sectionAcademic, $this->selectProperties, "class_id", $classID);

                    /** End $section Variable **/


                    /** Start $section Variable **/

                        /** Get The Subject By $classID From Teacher According To $id **/
                        $subjects = AppHelper::selectPropertiesWithWhere($this->subjectAcademic, $this->selectProperties, "class_id", $classID);

                    /** End $section Variable **/


                    /** Check Founding Id For Edit Data Of A Student **/
                    return AppHelper::CheckFoundingId(
                        $this->teacher,
                        $id,
                        "This Teacher Not Found",
                        "teachers.index",
                        "teachers::edit",
                        "teacher",
                        null,
                        null,
                        null,
                        $classes,
                        $sections,
                        $subjects
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }
            }

        /** End edit Method **/


                        /******************************************************************************/


        /** Start update Method **/

            /**
             * Update the specified resource in storage.
             * @param TeacherRequest $request
             * @param $id
             * @return RedirectResponse
             */
            public function update(TeacherRequest $request, $id)
            {
                try {

                    /** Start $teacher Variable **/

                        /** Find The Teacher With $id. **/
                        $teacher = AppHelper::FoundWithId($this->teacher, $id);

                    /** End $teacher Variable **/


                    /** Check If $id Not Found. **/
                    if (!$teacher) {

                        /** If True ($id Not Found) **/

                        /** Redirect To View Index With Error Message **/
                        return AppHelper::IfNotFound('This Teacher Not Found', "teachers.index");

                    }

                    /** If False ($id Founded) **/


                    /** Start $className Variable **/

                        /** Get THe Class Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id_teachers);

                    /** End $className Variable **/


                    /** Start $sectionName Variable **/

                        /** Get THe Section Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $sectionName = AppHelper::selectPropertyWithWhere($this->sectionAcademic, "name", "id", $request->section_id_teachers);

                    /** End $sectionName Variable **/


                    /** Start $sectionName Variable **/

                        /** Get THe Subject Name For Display It When Error Happen If The Class And Section Selected Are Not Available. **/
                        $subjectName = AppHelper::selectPropertyWithWhere($this->subjectAcademic, "name", "id", $request->subject_id_teachers);

                    /** End $sectionName Variable **/


                    /** Start $checkFounding Variable **/

                        /** Properties For Checking Of Values Of Requests Are In DB Or Not **/
                        $whereProperties = ["class_id_teachers", "section_id_teachers", "subject_id_teachers"];

                        /** Make Query Where On Teacher Table. **/
                        $checkFounding = AppHelper::checkFoundingForNotSaving($this->teacher, $request, $whereProperties);

                    /** End $checkFounding Variable **/


                    /** Start Check Founding Variable **/

                        /** For Check If Class Has Changed Or Not For Check Capacity **/
                        $foundClass = AppHelper::selectPropertyWithWhere($this->teacher, "class_id_teachers", "id", $id);

                        /** For Check If Section Has Changed Or Not For Check Capacity **/
                        $foundSection = AppHelper::selectPropertyWithWhere($this->teacher, "section_id_teachers", "id", $id);

                        /** For Check If Subject Has Changed Or Not For Check Capacity **/
                        $foundSubject = AppHelper::selectPropertyWithWhere($this->teacher, "subject_id_teachers", "id", $id);

                    /** End $foundClass Variable **/


                    /** Start Check Requests **/

                    /** End Check Requests **/

                    if($foundClass == $request->class_id_teachers && $foundSection == $request->section_id_teachers && $foundSubject == $request->subject_id_teachers) {

                        /** Start $data Variable **/

                            /**
                             ** Preparation Data Of New Student To Store In DB.
                             ** Excepting _token, photo, time.
                             ** _token By Default Don't Save In DB.
                             ** photo Except In First For Store It In Server With Hash Name And Add It To $data.
                             ** time Except In First For Creating Unique Folder From Milliseconds Of Time For Storing Photo In Them Then Add To $data.
                             ** students Disk For Store Photo That Belongs To Students Only.
                             **/
                            $data = AppHelper::DeleteStorePhotoIfFound($this->teacher, $id, $request, ["_token", "photo"], "teachers", "teachers");

                        /** End $data Variable **/


                        /** Start Update The Data Of The Teacher **/

                            /** Update Data Of The If $data Ready To Update In DB. **/
                            $teacher->update($data);

                        /** End Update The Data Of The Teacher **/


                        /** Start Return To Index View **/

                            /** Redirect To Index View If Teacher Has Been Updated Successfully **/
                            return AppHelper::IfSuccessfully('The Data Of Teacher Updated Successfully', "teachers.index");

                        /** End Return To Index View **/

                    } else {

                        if($checkFounding > 0) {

                            /** Return Redirect Back To Create View Of Teacher With Nice Message Appear The Error **/
                            return Redirect::back()->with("noCapacity", "Sorry You Can't Add $request->name Teacher To $className Class And $sectionName Section With $subjectName Subject.");

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
                                $data = AppHelper::DeleteStorePhotoIfFound($this->teacher, $id, $request, ["_token", "photo"], "teachers", "teachers");

                            /** End $data Variable **/


                            /** Start Update The Data Of The Teacher **/

                                /** Update Data Of The If $data Ready To Update In DB. **/
                                $teacher->update($data);

                            /** End Update The Data Of The Teacher **/


                            /** Start Return To Index View **/

                                /** Redirect To Index View If Teacher Has Been Updated Successfully **/
                                return AppHelper::IfSuccessfully('The Data Of Teacher Updated Successfully', "teachers.index");

                            /** End Return To Index View **/

                        }

                    }

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }
            }

        /** End update Method **/


                        /******************************************************************************/


        /** Start destroy Method **/

            /**
             * Remove the specified resource from storage.
             * @param $id
             * @return RedirectResponse
             */
            public function destroy($id)
            {
                try {

                    /** Start $teacher Variable **/

                        /** Find The Teacher With $id. **/
                        $teacher = AppHelper::FoundWithId($this->teacher, $id);

                    /** End $teacher Variable **/


                    /** Check If $id Not Found. **/
                    if (!$teacher) {

                        /** If True ($id Not Found) **/

                        /** Redirect To View Index With Error Message **/
                        return AppHelper::IfNotFound('This Teacher Not Found', "teachers.index");

                    }

                    /** If False ($id Founded) **/


                    /** Start $file Variable **/

                        /** Get The Path Folder Of Photo Of This Teacher. **/
                        $file = public_path() . "\images\\teachers\\" . $teacher->photo;

                    /** End $file Variable **/


                    /** Start Delete The Folder Of Photo **/

                        /** Delete The Folder Of Photo For This Teacher. **/
                        File::delete($file);

                    /** End Delete The Folder Of Photo **/


                    /** Start Delete The Teacher **/

                        /** Delete This Teacher. **/
                        $teacher->delete();

                    /** End Delete The Teacher **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Teacher Has Been Deleted Successfully **/
                        return AppHelper::IfSuccessfully('The Student Teacher Successfully', "teachers.index");

                    /** End Return To Index View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Teachers And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("teachers.index");

                }
            }

        /** End destroy Method **/

    }

/** End The TeachersController **/
