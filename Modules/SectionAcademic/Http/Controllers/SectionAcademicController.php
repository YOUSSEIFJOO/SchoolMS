<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\SectionAcademic\Http\Controllers;

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
    use Illuminate\Support\Str;
    use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start Model Of Section Academic Declaration **/

    use Modules\SectionAcademic\Entities\SectionAcademic;

/** End Model Of Section Academic Declaration **/


/** Start Model Of ClassAcademic Declaration **/

    use Modules\ClassAcademic\Entities\ClassAcademic;

/** End Model Of ClassAcademic Declaration **/


/** Start Section Academic Request Declaration **/

    use Modules\SectionAcademic\Http\Requests\SectionAcademicRequest;

/** End Section Academic Request Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The SectionAcademicController **/

    class SectionAcademicController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of SectionAcademic Model. **/
            private $sectionAcademic;

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

                /** For Declaring Instance Of Section Model. **/
                $this->sectionAcademic = new SectionAcademic;

                /** For Declaring Instance Of ClassAcademic Model. **/
                $this->classAcademic = new ClassAcademic;

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


                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start $sections Variable **/

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name", "capacity_students", "class_id"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["name", "class_id"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $sections = AppHelper::QuerySearch($this->sectionAcademic, $selectProperties, "class_id", "desc", $request, $whereProperties);

                    /** End $sections Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Class Academic With Variables **/
                        return view('sectionAcademic::index', compact("classes", "sections", "paginationNumber"))->with("instanceClass", $this->classAcademic);

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Section Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("sectionAcademic.index");

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

                    /** Start $classes Variable **/

                        /** Select Some Properties From ClassAcademic Table **/
                        $classes = $this->classes;

                    /** End $classes Variable **/


                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Section Academic With Variables **/
                        return view('sectionAcademic::create', compact("classes"));

                    /** End Return To Create View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Section Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("sectionAcademic.index");

                }
            }

        /** End create Method **/


                        /******************************************************************************/


        /** Start store Method **/

            /**
             * Store a newly created resource in storage.
             * @param SectionAcademicRequest $request
             * @return RedirectResponse
             */
            public function store(SectionAcademicRequest $request)
            {
                try{

                    /** Start $className Variable **/

                        /** Get THe Class Name For Display It When Error Happen If The Class Selected Are Not Available. **/
                        $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id);

                    /** End $className Variable **/


                    /** Start $countOfSections Variable **/

                        /** Count Rows From Student Table Where section_id === $request->section_id **/
                        $countSections = AppHelper::countRow($this->sectionAcademic, "class_id", $request->class_id);

                    /** End $countOfSections Variable **/


                    /** Start $capacitySections Variable **/

                        /** Get The Capacity Students For Check With Count Of Students From Section Academic. **/
                        $capacitySections = AppHelper::selectPropertyWithWhere($this->classAcademic,"capacity_sections","id", $request->class_id);

                    /** End $capacitySections Variable **/


                    /** Start If State For Check Capacity **/

                        if($countSections >= $capacitySections) {

                            /** If True Not Store This Section But Redirect Back With Nice Message Disappear The Error. **/
                            return Redirect::back()->with("noCapacity", "Sorry You Can't Add $request->name Section To $className Class. Try To Change The Class");

                        } else {

                            /** Start $data Variable **/

                                /** This Function For Handel All Requests Except _token. **/
                                $data = $request->except("_token");

                            /** End $data Variable **/


                            /** Start Create The Data Of New Section Academic **/

                                /** Create New Section Academic. **/
                                SectionAcademic::create($data);

                            /** End Create The Data Of New Section Academic **/


                            /** Start Return To Index View **/

                                /** Redirect To Index View If Section Academic Has Been Created Successfully **/
                                return AppHelper::IfSuccessfully('Section Created Successfully', "sectionAcademic.index");

                            /** End Return To Index View **/

                        }

                    /** End If State For Check Capacity **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Section Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("sectionAcademic.index");

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


                    /** Check Founding Id For Edit Data Of A Class  **/
                    return AppHelper::CheckFoundingId(
                        $this->sectionAcademic,
                        $id,
                        "This Section Is Not Found",
                        "sectionAcademic.index",
                        "sectionAcademic::edit",
                        "section",
                        null,
                        null,
                        null,
                        $classes
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Section Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("sectionAcademic.index");

                }
            }

        /** End edit Method **/


                        /******************************************************************************/


        /** Start update Method **/

            /**
             * Update the specified resource in storage.
             * @param SectionAcademicRequest $request
             * @param $id
             * @return RedirectResponse
             */
            public function update(SectionAcademicRequest $request, $id)
        {
            try {

                /** Start $className Variable **/

                    /** Get THe Class Name For Display It When Error Happen If The Class Selected Are Not Available. **/
                    $className = AppHelper::selectPropertyWithWhere($this->classAcademic, "name", "id", $request->class_id);

                /** End $className Variable **/


                /** Start $section Variable **/

                    /** Find The Class Academic With $id. **/
                    $section = AppHelper::FoundWithId($this->sectionAcademic, $id);

                /** End $section Variable **/


                /** Check If $id Not Found. **/
                if (!$section) {

                    /** If True ($id Not Found) **/

                    /** Redirect To View Index With Error Message **/
                    return AppHelper::IfNotFound('This Section Not Found', "sectionAcademic.index");

                }

                /** If False ($id Founded) **/


                /** Start $countOfSections Variable **/

                    /** Count Rows From Student Table Where section_id === $request->section_id **/
                    $countSections = AppHelper::countRow($this->sectionAcademic, "class_id", $request->class_id);

                /** End $countOfSections Variable **/


                /** Start $capacitySections Variable **/

                    /** Get The Capacity Students For Check With Count Of Students From Section Academic. **/
                    $capacitySections = AppHelper::selectPropertyWithWhere($this->classAcademic,"capacity_sections","id", $request->class_id);

                /** End $capacitySections Variable **/


                /** Start If State For Check Capacity **/

                if($countSections >= $capacitySections) {

                    /** If True Not Store This Section But Redirect Back With Nice Message Disappear The Error. **/
                    return Redirect::back()->with("noCapacity", "Sorry You Can't Add $request->name Section To $className Class. Try To Change The Class");

                } else {

                    /** Start $data Variable **/

                        /** This Function For Handel All Requests Except _token. **/
                        $data = $request->except("_token");

                    /** End $data Variable **/


                    /** Start Update The Data Of The Section Academic **/

                        /** Update Data Of The If $data Ready To Update In DB. **/
                        $section->update($data);

                    /** End Update The Data Of The Section Academic **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Section Academic Has Been Updated Successfully **/
                        return AppHelper::IfSuccessfully('The Data Of Section Updated Successfully', "sectionAcademic.index");

                    /** End Return To Index View **/

                }


            } catch(Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Section Academic And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("sectionAcademic.index");

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

                /** Start $section Variable **/

                    /** Find The Class Academic With $id. **/
                    $section = AppHelper::FoundWithId($this->sectionAcademic, $id);

                /** End $section Variable **/


                /** Check If $id Not Found. **/
                if (!$section) {

                    /** If True ($id Not Found) **/

                    /** Redirect To View Index With Error Message **/
                    return AppHelper::IfNotFound('This Section Not Found', "sectionAcademic.index");

                }

                /** If False ($id Founded) **/


                /** Start Delete The Data Of Section **/

                    /** Delete Section Academic. **/
                    $section->delete();

                /** End Delete The Data Of Class **/


                /** Start Return To Index View **/

                    /** Redirect To Index View If Section Academic Has Been Deleted Successfully **/
                    return AppHelper::IfSuccessfully('The Section Deleted Successfully', "sectionAcademic.index");

                /** End Return To Index View **/

            } catch(Exception $e) {

                /**
                 ** This Function For Handling If Unexpected Error Happened.
                 ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                 ** This Function Return To View Index Of Section Academic And Appear The Nice Message.
                 **/
                return AppHelper::IfUnexpectedError("sectionAcademic.index");

            }
        }

        /** End destroy Method **/

    }

/** End The SectionAcademicController **/
