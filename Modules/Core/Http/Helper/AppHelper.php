<?php

namespace Modules\Core\Http\Helper;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AppHelper
{

    /** Start Pagination Number **/


        /**
         ** Set The Number Of The Pagination.
         ********************************
         ** This Number For All Pagination In The System.
         **/
        const PAGINATE_NUMBER = 20;


    /** End Pagination Number **/


    /*******************************************************************************************************************/


    /** Start What Related To Index Method **/


        /** Start QuerySearch Method **/

            /**
             * Query Search Of Index Method.
             * @param $modelQuery       => This Model Will Do Query Of It.
             * @param $selectProperties => Properties That You Want To Select From $modelQuery.
             * @param $orderBy          => Any Column You Want To Order By It In Index View.
             * @param $typeOrder        => The Type of Order By (desc OR asc).
             * @param $request          => Request For Query Search.
             * @param $whereProperties  => These Properties For Check What Records That Similar To Search Value Of Inputs.
             * @return Collection
             */
            public static function QuerySearch($modelQuery, $selectProperties, $orderBy, $typeOrder, $request, $whereProperties) {

                return  $modelQuery->select($selectProperties)->orderBy($orderBy, $typeOrder)->

                        where(function($q) use ($request, $whereProperties) {

                            foreach($whereProperties as $property){

                                $q->where($property, "like", "%" . $request->$property . "%");

                            }

                        })->paginate(self::PAGINATE_NUMBER);

            }

        /** End QuerySearch Method **/


    /** End What Related To Index Method **/


    /*******************************************************************************************************************/



    /** Start What Related To Create Method **/

        /** Start checkAttendance Method **/

            /**
             * For Handling The Query Of Where For Check Attendance.
             * @param $modelQuery       => This Model Will Do Query Of It.
             * @param $request          => Request For Query Search.
             * @param $whereProperties  => These Properties For Check What Records That Similar To Search Value Of Inputs.
             * @return Collection
             */
            public static function checkAttendance($modelQuery, $request, $whereProperties) {

                return $modelQuery->where(function($q) use ($request, $whereProperties) {

                    foreach($whereProperties as $property){

                        $q->where($property, $request->$property);

                    }

                })->first();

            }

        /** End checkAttendance Method **/


                        /******************************************************************/


        /** Start QuerySearchCreate Method **/

            /**
             * Get Records From Table By Where Query.
             * @param $modelQuery       => This Model Will Do Query Of It.
             * @param $request          => Request For Query Search.
             * @param $whereProperties  => These Properties For Check What Records That Similar To Search Value Of Inputs.
             * @return Collection
             */
            public static function QuerySearchCreate($modelQuery, $request, $whereProperties) {

                return $modelQuery->where(function($q) use ($request, $whereProperties) {

                    foreach($whereProperties as $property){

                        $q->where($property, $request->$property);

                    }

                })->get();

            }

        /** End QuerySearchCreate Method **/


    /** End What Related To Create Method **/


    /*******************************************************************************************************************/


    /** Start What Related To Store Method **/


        /** Start checkFoundingForNotSaving Method **/

            /**
             * Check Founding Values Come From Request Of Store Method For Prevent This Records From Saving In DB.
             * @param $modelQuery       => This Model Will Do Query Of It.
             * @param $request          => Request For Query Search.
             * @param $whereProperties  => These Properties For Check Do These Records From Class And Section Are In $modelQuery.
             * @return Collection
             */
            public static function checkFoundingForNotSaving($modelQuery, $request, $whereProperties) {

                return $modelQuery::where(function($q) use ($request, $whereProperties) {

                            foreach($whereProperties as $property){

                                $q->where($property, $request->$property);

                            }

                        })->count();

            }

        /** End checkFoundingForNotSaving Method **/


                        /******************************************************************/


        /** Start selectPropertyWithWhere Method **/

            /**
             * Select Property From A Model By Where Query And Get The Value Of This Property.
             * @param $modelQuery                       => This Model Will Do Query Of It.
             * @param $selectProperty                   => Property That You Want To Select From $modelQuery.
             * @param $whereProperty                    => This Property For Select $selectProperty According To Where Query In $modelQuery.
             * @param $equalPropertyOfWhereProperty     => This Property For Check If Equal To $whereProperty Or Not.
             * @return Collection
             */
            public static function selectPropertyWithWhere($modelQuery,$selectProperty, $whereProperty, $equalPropertyOfWhereProperty) {

                return $modelQuery->select($selectProperty)->where($whereProperty, $equalPropertyOfWhereProperty)->first()[$selectProperty];

            }

        /** End selectPropertyWithWhere Method **/


                        /******************************************************************/


        /** Start countRow Method **/

            /**
             * Count Rows From Table Connect With $modelQuery According To Where Query.
             * @param $modelQuery                       => This Model Will Do Query Of It.
             * @param $whereProperty                    => Property That You Want To Select From $modelQuery.
             * @param $equalPropertyOfWhereProperty     => This Property For Check If Equal To $whereProperty Or Not.
             * @return Collection
             */
            public static function countRow($modelQuery, $whereProperty, $equalPropertyOfWhereProperty) {

                return $modelQuery->where($whereProperty, $equalPropertyOfWhereProperty)->count();

            }

        /** End countRow Method **/


                        /******************************************************************/


        /** Start StorePhotoIfFound Method **/

            /**
             * Count Rows From Table Connect With $modelQuery According To Where Query.
             * @param $request          => Request For Except Some Data.
             * @param $exceptProperties => Properties For Excepting It In First Then Add Some Of Them To $data To Store In DB.
             * @param $diskSave         => The Special Disk For Store Related Photo In It.
             * @return Collection
             */
            public static function StorePhotoIfFound($request, $exceptProperties, $diskSave) {

                /** Handle All Requests Except $exceptProperties. **/
                $data = $request->except($exceptProperties);

                /** Check If Found Photo Or Not. **/
                if($request->hasfile('photo')) {

                    /** Handle Hash Name Of Photo. **/
                    $hashNamePhoto = Str::random(15). "_" . time() . "_" . $request->file('photo')->getClientOriginalName();

                    /** Save Photo In Related Disk. **/
                    $request->file('photo')->storeAs("", $hashNamePhoto, $diskSave);

                    /** Add The Value Of Request photo To $data. **/
                    $data["photo"] = $hashNamePhoto;

                }

                /** Encrypt Password. **/
                $data["password"] = encrypt($request->password);

                /** Return What Store In DB. **/
                return $data;

            }

        /** End StorePhotoIfFound Method **/


                    /******************************************************************/


        /** Start HandelRequestArrays Method **/

            /**
             * Handle Array Of Values Come From Request.
             * @param $request          => Request For Except Some Data.
             * @return array
             */
            public static function HandelRequestArrays($request) {

                /** This Empty Array For Put In It Arrays From Request Arrays Of Student Attendance. **/
                $data = [];

                /** For Loop For Looping In Arrays That Come From Student Attendance. **/
                for($i = 0; $i < count($request->name); $i++) {

                    array_push($data, array(

                        "name"                  => $request->name[$i],
                        "class_id_students"     => $request->class_id_students[$i],
                        "section_id_students"   => $request->section_id_students[$i],
                        "student_id"            => $request->student_id_students[$i],
                        "date"                  => $request->date[$i],
                        "status"                => $request->status[$i]

                    ));
                }

                return $data;
            }

        /** End HandelRequestArrays Method **/


    /** End What Related To Store Method **/


    /*******************************************************************************************************************/


    /** Start What Related To Show Method **/


        /** Start CheckFoundingId Method **/

            /**
             * Check Founding Id For Show Data Of The Element.
             * @param $modelQuery               => This Model Will Do Query Of It (Check Founding About Row By ID).
             * @param $id                       => This ID For Query Of $modelQuery.
             * @param $messageError             => This Message Will Display When $id Not Found.
             * @param $routeIfNotFound          => This Route Will Be Directed To It If $id Not Found.
             * @param $viewIfFound              => This View Will Be Directed To It If $id Has Been Found.
             * @param $instancePassingToView    => This Instance Will Be Passing To $routeIfFound.
             * @param $instanceClass            => This Instance Will Be Passing To $routeIfFound For Get The Name Of Class.
             * @param $instanceSection          => This Instance Will Be Passing To $routeIfFound For Get The Name Of Section.
             * @param $instanceSubject          => This Instance Will Be Passing To $routeIfFound For Get The Name Of Subject.
             * @param $classes
             * @param $sections
             * @param $subjects
             * @return Application|Factory|RedirectResponse|View
             */
            public static function CheckFoundingId($modelQuery, $id, $messageError, $routeIfNotFound, $viewIfFound, $instancePassingToView, $instanceClass = NULL, $instanceSection = NULL, $instanceSubject = NULL, $classes = NULL, $sections = NULL, $subjects = NULL) {

                /** This Function For Founding Who Have $id. **/
                $resultCheck = $modelQuery->find($id);

                /** Check If This Element Not Found. **/
                if (!$resultCheck) {

                    /** This Message Will Display When $id Not Found **/
                    Session::flash('danger', $messageError);

                    /** Redirect To $routeName If $id Not Found **/
                    return redirect()->route($routeIfNotFound);

                } else {

                    /** Array Have Variables That Pass To View. **/
                    $passingVariables = [

                        /** This Instance Will Be Passing To $routeIfFound. **/
                        $instancePassingToView  => $resultCheck,

                        /** Pass Instance Of Class To Show View For Get The Name Of Class. **/
                        "instanceClass"         => $instanceClass,

                        /** Pass Instance Of Section To Show View For Get The Name Of Section. **/
                        "instanceSection"       => $instanceSection,

                        /** Pass Instance Of Subject To Show View For Get The Name Of Subject. **/
                        "instanceSubject"       => $instanceSubject,

                        /** Pass Classes Where Class ID In $modelQuery Equal To ID In Class Academic Table To Show ID And Name In $viewIfFound. **/
                        "classes" => $classes,

                        /** Pass Sections Where Class ID In $modelQuery Equal To Class ID In Section Academic Table To Show ID And Name In $viewIfFound. **/
                        "sections" => $sections,

                        /** Pass Subjects Where Class ID In $modelQuery Equal To Class ID In Subject Academic Table To Show ID And Name In $viewIfFound. **/
                        "subjects" => $subjects

                    ];

                    /** Redirect To $routeIfFound If $id Has Been Found. **/
                    return view("$viewIfFound", $passingVariables);

                }
            }

        /** End CheckFoundingId Method **/


    /** End What Related To Show Method **/


    /*******************************************************************************************************************/


    /** Start What Related To Edit Method **/


        /** Start selectPropertyWithWhere Method **/

            /**
             * Select Property From A Model By Where Query And Get The Value Of This Property.
             * @param $modelQuery                       => This Model Will Do Query Of It.
             * @param $selectProperty                   => Property That You Want To Select From $modelQuery.
             * @param $whereProperty                    => This Property For Select $selectProperty According To Where Query In $modelQuery.
             * @param $equalPropertyOfWhereProperty     => This Property For Check If Equal To $whereProperty Or Not.
             * @return Collection
             */
            public static function selectPropertiesWithWhere($modelQuery, $selectProperty, $whereProperty, $equalPropertyOfWhereProperty) {

                return $modelQuery->select($selectProperty)->where($whereProperty, $equalPropertyOfWhereProperty)->get();

            }

        /** End selectPropertyWithWhere Method **/


    /** End What Related To Edit Method **/


    /*******************************************************************************************************************/


    /** Start What Related To Update Method **/

        /** Start FoundWithId Method **/

            /**
             * Check Founding Who Have $id.
             * @param $modelQuery   => This Model Will Do Query Of It.
             * @param $id           => What Search With It In $modelQuery.
             * @return Collection
             */
            public static function FoundWithId($modelQuery, $id)
            {

                /** Get The Element Who Have $id. **/
                return $modelQuery->find($id);
            }

        /** End FoundWithId Method **/


                            /******************************************************************/


        /** Start IfNotFound Method **/

            /**
             * If Error Happen During Search About Id Of Update Method.
             * @param $message      => The Message Will appear To Explain Error Happen By Not Founding ID.
             * @param $routeName    => The Route Will Direct To It.
             * @return RedirectResponse
             */
            public static function IfNotFound($message, $routeName) {

                /** The Message Will appear To Explain Error Happen By Not Founding ID. **/
                Session::flash('danger', $message);

                /** The Route Will Direct To It. **/
                return redirect()->route($routeName);

            }

        /** End IfNotFound Method **/


                            /******************************************************************/


        /** Start DeleteStorePhotoIfFound Method **/

            /**
             * Delete Old Photo And Save New Photo.
             * @param $modelQuery           => This Model Will Do Query Of It.
             * @param $id                   => What Search With It In $modelQuery.
             * @param $request              => Request For Except Some Data.
             * @param $exceptProperties     => Except Properties For Handel Delete And Store Operation.
             * @param $folderPhoto          => Where The Photo Has Been Stored In Store Method.
             * @param $diskSave             => Where The Photo Store In Server.
             * @return RedirectResponse
             */
            public static function DeleteStorePhotoIfFound($modelQuery, $id, $request, $exceptProperties, $folderPhoto, $diskSave) {

                /** Finding Who Have $id. **/
                $element = $modelQuery->find($id);

                /** Except Photo Request To Handel Delete And Store Operation. **/
                $data = $request->except($exceptProperties);

                /** If Request Has Photo. **/
                if($request->hasfile("photo")) {

                    /** Get The Path Photo Of The Element. **/
                    $file = public_path() . "\images\\$folderPhoto\\" . $element->photo;

                    /** Delete The Photo For This Element. **/
                    File::delete($file);

                    /** Handle Hash Name Of Photo. **/
                    $hashNamePhoto = Str::random(15). "_" . time() . "_" . $request->file('photo')->getClientOriginalName();

                    /** Save Image In The $diskSave. **/
                    $request->file('photo')->storeAs("", $hashNamePhoto, $diskSave);

                    /** Update Photo Request To $data Of Requests. **/
                    $data["photo"] = $hashNamePhoto;

                }

                /** Encrypt Password. **/
                $data["password"] = encrypt($request->password);

                /** $data That Have All Requests And Ready To Update In DB. **/
                return $data;

            }

        /** End DeleteStorePhotoIfFound Method **/


    /** End What Related To Update Method **/


    /*******************************************************************************************************************/


    /** Start What Related To Global Method **/


        /** Start selectProperty Method **/

            /**
             * This Function For Select Some Properties From $modelQuery.
             * @param $modelQuery   => This Model Will Do Query Of It.
             * @param $properties   => The Properties That Select From $modelQuery.
             * @return Collection
             */
            public static function selectProperty($modelQuery, $properties) {

                return $modelQuery->select($properties)->get();

            }

        /** End selectProperty Method **/


                        /******************************************************************/


        /** Start IfUnexpectedError Method **/

            /**
             * If Unexpected Error Happen Redirect To $routeName.
             * @param $routeName   => The Route Will Direct To It.
             * @return RedirectResponse
             */
            public static function IfUnexpectedError($routeName) {

                /** Display This Message If Error Happened. **/
                Session::flash('danger', 'Something Went Wrong, Please Try Again');

                /** Redirect To $routeName View If Error Happened. **/
                return redirect()->route($routeName);
            }

        /** End IfUnexpectedError Method **/


                        /******************************************************************/


        /** Start IfSuccessfully Method **/

            /**
             * Redirect To $routeName If Successfully Store Method.
             * @param $message      => Display This Message If Method Successfully.
             * @param $routeName    => The Route Will Direct To It.
             * @return RedirectResponse
             */
            public static function IfSuccessfully($message, $routeName) {

                /** Display This Message If Method Successfully. **/
                Session::flash('success', $message);

                /** Redirect If Success To Index Of Route. **/
                return redirect()->route($routeName);

            }

        /** End IfSuccessfully Method **/


                        /******************************************************************/


        /** Start allGuards Method **/

            /** This Function To Put In It All Guards In System To Use In Any Where Dynamically. **/
            public static function allGuards() {

                return ["student", "teacher", "employee"];

            }

        /** End allGuards Method **/


                        /******************************************************************/

        /** Start allRoles Method **/

            /** This Function To Put In It All Roles In System To Use In Any Where Dynamically. **/
            public static function allRoles() {

                return ["student", "teacher", "employee", "admin", "superAdmin"];

            }

        /** End allRoles Method **/


                    /******************************************************************/

        /** Start allModules Method **/

            /** This Function To Put In It All Modules In System To Use In Any Where Dynamically. **/
            public static function allModules() {

                return [
                        "student", "teacher", "employee", "student attendance", "teacher attendance", "employee attendance",
                        "class academic", "section academic", "subject academic", "permissions"
                        ];

            }

        /** End allModules Method **/


                    /******************************************************************/

        /** Start ReplaceSpaceWithUnderScore Method **/

            /**
             * Redirect To $routeName If Successfully Store Method.
             * @param $stringReplace      => Replace Space With Under Score.
             * @return RedirectResponse|string|string[]
             */
            public static function ReplaceSpaceWithUnderScore($stringReplace) {

                return preg_replace('/\s+/', '_', $stringReplace);

            }

        /** End ReplaceSpaceWithUnderScore Method **/


                    /******************************************************************/


        /** Start currentGuard Method **/

            /**
             * This Function To Get The Current Guard.
             * @return string
             **/
            public static function currentGuard() {

                $guards = self::allGuards();

                foreach($guards as $guard) {

                    if (Auth::guard($guard)->check()) {

                        return $guard;
                    }

                }

            }

        /** End currentGuard Method **/


                        /******************************************************************/


        /** Start CheckAuth Method **/

            /** This Function To Check :-
             * First    => If Enter User To Dashboard Is Authenticate Or Not.
             * Second   => If Authenticate Person Try To Go To Login Page.
             * @param $routeIfAuthenticate  => This Route Will Direct To It If Authenticate.
             * @return Application|Factory|RedirectResponse|View
            */
            public static function CheckAuth($routeIfAuthenticate) {

                $result = array();

                $guards = self::allGuards();

                foreach($guards as $guard) {

                    $result[] = !Auth::guard($guard)->check();

                }

                if(array_search(false, $result)) {

                    return redirect()->route($routeIfAuthenticate);

                } else {

                    return view('core::login.login');

                }

            }

        /** End CheckAuth Method **/


    /** Start currentGuard Method **/


    /** End What Related To Global Method **/


    /*******************************************************************************************************************/


    /** Start What Related To Views **/


        /** Start upperWords Method **/

            /**
             * Convert String To Uppercase Of Words.
             * @param $val   => The Value That Will Be Uppercase In It Words.
             * @return string
             */
            public static function upperWords($val) {

                return ucwords($val);

            }

        /** End upperWords Method **/


                        /******************************************************************/


        /** Start photoOfCurrentAuth Method **/

            /** This Function To Get The Image Of Current Who Authenticated By The Its Guard. **/
            public static function photoOfCurrentAuth() {

                $guards = self::allGuards();

                foreach($guards as $guard) {

                    if (Auth::guard($guard)->check()) {

                        $namePhoto = Auth::guard($guard)->user()->photo;

                        return "images/$guard" . "s/$namePhoto";
                    }

                }

            }

        /** End photoOfCurrentAuth Method **/

    /** End What Related To Views **/

}
