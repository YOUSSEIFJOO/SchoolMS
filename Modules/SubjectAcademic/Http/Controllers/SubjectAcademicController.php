<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\SubjectAcademic\Http\Controllers;

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
    use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start Model Of Subject Academic Declaration **/

    use Modules\SubjectAcademic\Entities\SubjectAcademic;

/** End Model Of Subject Academic Declaration **/


/** Start Model Of ClassAcademic Declaration **/

    use Modules\ClassAcademic\Entities\ClassAcademic;

/** End Model Of ClassAcademic Declaration **/


/** Start Subject Academic Request Declaration **/

    use Modules\SubjectAcademic\Http\Requests\SubjectAcademicRequest;

/** End Subject Academic Request Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The SubjectAcademicController **/

    class SubjectAcademicController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of SubjectAcademic Model. **/
            private $subjectAcademic;

            /** For Declaring Instance Of ClassAcademic Model. **/
            private $classAcademic;

            /** For Declaring Some Properties Will Selected From Class Academic **/
            private $selectProperties;

            /** For Declaring Query Of Class Academic. **/
            private $classes;

        /** End Declaration Properties Of This Controller **/


                        /******************************************************************************/


        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Subject Model. **/
                $this->subjectAcademic = new SubjectAcademic;

                /** For Declaring Instance Of ClassAcademic Model. **/
                $this->classAcademic = new ClassAcademic;

                /** This Array To Put In It The Properties That You Want To Select It For Show All Classes. **/
                $this->selectProperties = ["id", "name"];

                /** Select Some Properties From ClassAcademic Table **/
                $this->classes = AppHelper::selectProperty($this->classAcademic, $this->selectProperties);
            }

        /** End The Construct Method **/


                        /******************************************************************************/



        /** Start index Method **/

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


                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $sections Variable **/

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name", "code", "class_id"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["name", "code", "class_id"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $subjects = AppHelper::QuerySearch($this->subjectAcademic, $selectProperties, "class_id", "desc", $request, $whereProperties);

                    /** End $sections Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Subject Academic With Variables **/
                        return view('subjectAcademic::index', compact("subjects", "paginationNumber", "classes"))->with("instanceClass", $this->classAcademic);

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Subject Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("subjectAcademic.index");

                }
            }

        /** End index Method **/


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

                        /** Redirect To Create View Of Subject Academic With Variables **/
                        return view('subjectAcademic::create', compact("classes"));

                    /** End Return To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Subject Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("subjectAcademic.index");

                }
            }

        /** End create Method **/


                        /******************************************************************************/


        /** Start store Method **/

            /**
             * Store a newly created resource in storage.
             * @param SubjectAcademicRequest $request
             * @return RedirectResponse
             */
            public function store(SubjectAcademicRequest $request)
            {
                try{

                    /** Start $className Variable **/

                        /** Get THe Class Name For Display It When Error Happen If The Class Selected Are Not Available. **/
                        $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id);

                    /** End $className Variable **/


                    /** Start $capacitySections Variable **/

                        /** Get The Capacity Subjects For Check With Count Of Subjects From Subject Academic. **/
                        $capacitySubjects = AppHelper::selectPropertyWithWhere($this->classAcademic,"capacity_subjects","id", $request->class_id);

                    /** End $capacitySections Variable **/


                    /** Start $countOfSections Variable **/

                        /** Count Rows From Subject Table Where section_id === $request->class_id **/
                        $countSubjects = AppHelper::countRow($this->subjectAcademic, "class_id", $request->class_id);

                    /** End $countOfSections Variable **/


                    /** Start If State For Check Capacity **/

                    if($countSubjects >= $capacitySubjects) {

                        /** If True Not Store This Subject But Redirect Back With Nice Message Disappear The Error. **/
                        return Redirect::back()->with("noCapacity", "Sorry You Can't Add $request->name Section To $className Class. Try To Change The Class");

                    } else {

                        /** Start $data Variable **/

                            /** This Function For Handel All Requests Except _token. **/
                            $data = $request->except("_token");

                        /** End $data Variable **/


                        /** Start Create The Data Of New Subject Academic **/

                            /** Create New Subject Academic. **/
                            SubjectAcademic::create($data);

                        /** End Create The Data Of New Subject Academic **/


                        /** Start Return To Index View **/

                            /** Redirect To Index View If Subject Academic Has Been Created Successfully **/
                            return AppHelper::IfSuccessfully('Subject Created Successfully', "subjectAcademic.index");

                        /** End Return To Index View **/

                    }

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Subject Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("subjectAcademic.index");

                }
            }

        /** End store Method **/


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


                    /** Check Founding Id For Edit Data Of A Subject  **/
                    return AppHelper::CheckFoundingId(
                        $this->subjectAcademic,
                        $id,
                        "This Subject Is Not Found",
                        "subjectAcademic.index",
                        "subjectAcademic::edit",
                        "subject",
                        null,
                        null,
                        null,
                        $classes
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Subject Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("subjectAcademic.index");

                }
            }

        /** End edit Method **/


                        /******************************************************************************/


        /** Start update Method **/

            /**
             * Update the specified resource in storage.
             * @param SubjectAcademicRequest $request
             * @param $id
             * @return RedirectResponse
             */
            public function update(SubjectAcademicRequest $request, $id)
            {
                try {

                    /** Start $className Variable **/

                        /** Get THe Class Name For Display It When Error Happen If The Class Selected Are Not Available. **/
                        $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id);

                    /** End $className Variable **/


                    /** Start $subject Variable **/

                        /** Find The Subject Academic With $id. **/
                        $subject = AppHelper::FoundWithId($this->subjectAcademic, $id);

                    /** End $subject Variable **/

                    /** Check If $id Not Found. **/
                    if (!$subject) {

                        /** If True ($id Not Found) **/

                        /** Redirect To View Index With Error Message **/
                        return AppHelper::IfNotFound('This Subject Not Found', "subjectAcademic.index");

                    }

                    /** If False ($id Founded) **/


                    /** Start $capacitySections Variable **/

                        /** Get The Capacity Subjects For Check With Count Of Subjects From Subject Academic. **/
                        $capacitySubjects = AppHelper::selectPropertyWithWhere($this->classAcademic,"capacity_subjects","id", $request->class_id);

                    /** End $capacitySections Variable **/


                    /** Start $countOfSections Variable **/

                        /** Count Rows From Subject Table Where section_id === $request->class_id **/
                        $countSubjects = AppHelper::countRow($this->subjectAcademic, "class_id", $request->class_id);

                    /** End $countOfSections Variable **/


                    /** Start If State For Check Capacity **/

                    if($countSubjects >= $capacitySubjects) {

                        /** If True Not Store This Subject But Redirect Back With Nice Message Disappear The Error. **/
                        return Redirect::back()->with("noCapacity", "Sorry You Can't Add $request->name Section To $className Class. Try To Change The Class");

                    } else {

                        /** Start $data Variable **/

                            /** This Function For Handel All Requests Except _token. **/
                            $data = $request->except("_token");

                        /** End $data Variable **/


                        /** Start Update The Data Of The Subject Academic **/

                            /** Update Data Of The If $data Ready To Update In DB. **/
                            $subject->update($data);

                        /** End Update The Data Of The Subject Academic **/


                        /** Start Return To Index View **/

                            /** Redirect To Index View If Section Academic Has Been Updated Successfully **/
                            return AppHelper::IfSuccessfully('The Data Of Subject Updated Successfully', "subjectAcademic.index");

                        /** End Return To Index View **/

                    }

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Subject Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("subjectAcademic.index");

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

                /** Start $subject Variable **/

                    /** Find The Subject Academic With $id. **/
                    $subject = AppHelper::FoundWithId($this->subjectAcademic, $id);

                /** End $subject Variable **/

                /** Check If $id Not Found. **/
                if (!$subject) {

                    /** If True ($id Not Found) **/

                    /** Redirect To View Index With Error Message **/
                    return AppHelper::IfNotFound('This Subject Not Found', "subjectAcademic.index");

                }

                /** If False ($id Founded) **/


                /** Start Delete The Data Of Subject **/

                    /** Delete Subject Academic. **/
                    $subject->delete();

                /** End Delete The Data Of Subject **/


                /** Start Return To Index View **/

                    /** Redirect To Index View If Subject Academic Has Been Deleted Successfully **/
                    return AppHelper::IfSuccessfully('The Subject Deleted Successfully', "subjectAcademic.index");

                /** End Return To Index View **/

            } catch(Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Subject Academic And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("subjectAcademic.index");

            }
        }

        /** End destroy Method **/

    }

/** End The SubjectAcademicController **/
