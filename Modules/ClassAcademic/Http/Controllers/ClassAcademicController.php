<?php


/** Start The NameSpace Of This Controller **/

    namespace Modules\ClassAcademic\Http\Controllers;

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
    use Illuminate\Support\Str;
    use Illuminate\View\View;

/** End View Helper Declaration **/


/** Start Model Of Class Academic Declaration **/

    use Modules\ClassAcademic\Entities\ClassAcademic;

/** End Model Of Class Academic Declaration **/


/** Start Class Academic Request Declaration **/

    use Modules\ClassAcademic\Http\Requests\ClassAcademicRequest;

/** End Class Academic Request Declaration **/


/** Start App Helper Class Declaration **/

    use Modules\Core\Http\Helper\AppHelper;

/** End App Helper Class Declaration **/


                        /******************************************************************************/


/** Start The ClassAcademicController **/

    class ClassAcademicController extends Controller
    {

        /** Start Declaration Properties Of This Controller **/

            /** For Declaring Instance Of Student Model. **/
            private $classAcademic;

        /** End Declaration Properties Of This Controller **/


                        /******************************************************************************/


        /** Start The Construct Method **/

            public function __construct()
            {

                /** For Declaring Instance Of Employee Model. **/
                $this->classAcademic = new ClassAcademic;

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

                        /** This Array To Put In It The Properties That You Want To Select It For Index View. **/
                        $selectProperties = ["id", "name", "capacity_sections", "capacity_subjects"];

                        /** This Array To Put In It The Properties That Are Use In Check The Value Of Inputs Are Like The Values In DB. **/
                        $whereProperties = ["name"];

                        /**
                         ** Select Properties From Model ($selectProperties).
                         ** Ordering Data By Column You Select It And Type Of Ordering.
                         ** Search What Values Of Inputs In Index View Like Values In DB.
                         ** Return With Pagination Number.
                         **/
                        $classes = AppHelper::QuerySearch($this->classAcademic, $selectProperties, "capacity_sections", "desc", $request, $whereProperties);

                    /** End $classes Variable **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View Of Class Academic With Variables **/
                        return view('classacademic::index', compact("classes", "paginationNumber"));

                    /** End Return To Index View **/

                } catch (Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Class Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("classAcademic.index");

                }
            }

        /** End Index Method **/


        /** Start create Method **/

            /**
             * Show the form for creating a new resource.
             * @return Application|Factory|RedirectResponse|View
             */
            public function create()
            {
                try {

                    /** Start Return To Create View **/

                        /** Redirect To Create View Of Class Academic With Variables **/
                        return view('classacademic::create');

                    /** End Return To Create View **/


                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Class Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("classAcademic.index");

                }
            }

        /** End create Method **/


        /** Start store Method **/

            /**
             * Store a newly created resource in storage.
             * @param ClassAcademicRequest $request
             * @return RedirectResponse
             */
            public function store(ClassAcademicRequest $request)
            {
                try{

                    /** Start $data Variable **/

                        /** This Function For Handel All Requests Except _token. **/
                        $data = $request->except("_token");

                    /** End $data Variable **/


                    /** Start Create The Data Of New Class Academic **/

                        /** Create New Class Academic. **/
                        ClassAcademic::create($data);

                    /** End Create The Data Of New Class Academic **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Class Academic Has Been Created Successfully **/
                        return AppHelper::IfSuccessfully('Class Created Successfully', "classAcademic.index");

                    /** End Return To Index View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Class Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("classAcademic.index");

                }
            }

        /** End store Method **/


        /** Start edit Method **/

            /**
             * Show the form for editing the specified resource.
             * @param $id
             * @return RedirectResponse
             */
            public function edit($id)
            {
                try {

                    /** Check Founding Id For Edit Data Of A Class  **/
                    return AppHelper::CheckFoundingId(
                        $this->classAcademic,
                        $id,
                        "This Class Is Not Found",
                        "classAcademic.index",
                        "classacademic::edit",
                        "class"
                    );

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Class Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("classAcademic.index");

                }
            }

        /** End edit Method **/


        /** Start update Method **/

            /**
             * Update the specified resource in storage.
             * @param ClassAcademicRequest $request
             * @param $id
             * @return RedirectResponse
             */
            public function update(ClassAcademicRequest $request, $id)
            {
                try {

                    /** Start $class Variable **/

                        /** Find The Class Academic With $id. **/
                        $class = AppHelper::FoundWithId($this->classAcademic, $id);

                    /** End $class Variable **/


                    /** Check If $id Not Found. **/
                    if (!$class) {

                        /** If True ($id Not Found) **/

                        /** Redirect To View Index With Error Message **/
                        return AppHelper::IfNotFound('This Class Not Found', "classAcademic.index");

                    }

                    /** If False ($id Founded) **/

                    /** Start $data Variable **/

                        /** This Function For Handel All Requests Except _token. **/
                        $data = $request->except("_token");

                    /** End $data Variable **/


                    /** Start Update The Data Of The Class Academic **/

                        /** Update Data Of The If $data Ready To Update In DB. **/
                        $class->update($data);

                    /** End Update The Data Of The Class Academic **/

                    /** Start Return To Index View **/

                        /** Redirect To Index View If Class Academic Has Been Updated Successfully **/
                        return AppHelper::IfSuccessfully('The Data Of Class Updated Successfully', "classAcademic.index");

                    /** End Return To Index View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Class Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("classAcademic.index");

                }
            }

        /** End update Method **/


        /** Start destroy Method **/

            /**
             * Remove the specified resource from storage.
             * @param $id
             * @return RedirectResponse
             */
            public function destroy($id)
            {
                try {

                    /** Start $class Variable **/

                        /** Find The Class Academic With $id. **/
                        $class = AppHelper::FoundWithId($this->classAcademic, $id);

                    /** End $class Variable **/


                    /** Check If $id Not Found. **/
                    if (!$class) {

                        /** If True ($id Not Found) **/

                        /** Redirect To View Index With Error Message **/
                        return AppHelper::IfNotFound('This Class Not Found', "classAcademic.index");

                    }

                    /** If False ($id Founded) **/


                    /** Start Delete The Data Of Class **/

                        /** Delete Class Academic. **/
                        $class->delete();

                    /** End Delete The Data Of Class **/


                    /** Start Return To Index View **/

                        /** Redirect To Index View If Class Academic Has Been Deleted Successfully **/
                        return AppHelper::IfSuccessfully('The Class Deleted Successfully', "classAcademic.index");

                    /** End Return To Index View **/

                } catch(Exception $e) {

                    /**
                     ** This Function For Handling If Unexpected Error Happened.
                     ** For Not Display The Laravel Error. Display Nice Message That Appear That Error Happened.
                     ** This Function Return To View Index Of Class Academic And Appear The Nice Message.
                     **/
                    return AppHelper::IfUnexpectedError("classAcademic.index");

                }
            }

        /** End destroy Method **/
    }

/** End The ClassAcademicController **/
