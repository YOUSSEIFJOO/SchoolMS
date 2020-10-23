<?php

namespace Modules\SubjectAcademic\Http\Controllers;

// The Basics :-
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

// View :-
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

// Subject Academic Request :-
use Modules\SubjectAcademic\Http\Requests\SubjectAcademicRequest;

// Class Academic Request :-
use Modules\ClassAcademic\Entities\ClassAcademic;

// Subject Academic Model :-
use Modules\SubjectAcademic\Entities\SubjectAcademic;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;

class SubjectAcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function index(Request $request)
    {
        try {

            // Get The Pagination Number.
            $paginationNumber = AppHelper::PAGINATE_NUMBER;

            // Select Name Of Class Academic.
            $classes = AppHelper::selectProperty((new ClassAcademic()),  ["id", "name"]);

            // Make Query Search.
            $subjects = AppHelper::QuerySearch(
                $request,
                ["name", "code", "class_id"],
                "code",
                (new SubjectAcademic())
            );

            // Redirect To Index View Of Subjects Academic With Two Variables.
            return view('subjectacademic::index', compact("subjects", "paginationNumber", "classes"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("subjectAcademic.index");

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        try {

            // Random Number For Code Column.
            $randomNum = AppHelper::randNumber();

            // Select Name Of Class Academic.
            $classes = AppHelper::selectProperty((new ClassAcademic()),  ["id", "name"]);

            /** Start Check Capacity **/

                // Capacity Of Class.
                $capacity = AppHelper::capacityClass((new ClassAcademic()), "id", "capacity_subjects");

                // Count Of Subjects
                $count = AppHelper::countColumnOfProperty($capacity, (new SubjectAcademic()), "class_id");

                // Check Capacity
                $checkCapacity = AppHelper::checkCapacity($capacity, $count);

                // Return With CheckCapacity Variable If Found Class Has Full From Subjects.
                return view("subjectacademic::create", compact("classes", "randomNum", "checkCapacity"));

            /** End Check Capacity **/

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("subjectAcademic.index");

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param SubjectAcademicRequest $request
     * @return RedirectResponse
     */
    public function store(SubjectAcademicRequest $request)
    {
        try{

            // Count Of Column Subjects Of Subject Academic Table.
            $countOfSubjects = AppHelper::countColumn((new SubjectAcademic()), "class_id", $request, "class_ic");

            // Value Of Capacity Subjects Row.
            $capacityOfSubjects = AppHelper::valueRow((new classAcademic()), "capacity_subjects", "id", $request, "class_id");

            if($countOfSubjects < $capacityOfSubjects) {

                // Get All Requests Except _token.
                $data = $request->except("_token");

                // Create New Subject.
                SubjectAcademic::create($data);

                // This Function For Handling Redirecting To Index View If Subjects Academic Has Been Created Successfully.
                return AppHelper::IfSuccessfully("Subject Created Successfully", "subjectAcademic.index");

            } else {

                // Return Back If Condition Not Valid.
                return Redirect::back()->with("noCapacity", "Sorry You Can't Add Subjects To THis Class.");

            }

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("subjectAcademic.index");

        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return RedirectResponse
     */
    public function edit($id)
    {
        try {

            /** Start Check Capacity **/

                // Capacity Of Class.
                $capacity = AppHelper::capacityClass((new ClassAcademic()), "id", "capacity_subjects");

                // Count Of Subjects
                $count = AppHelper::countColumnOfProperty($capacity, (new SubjectAcademic()), "class_id");

                // Check Capacity
                $checkCapacity = AppHelper::checkCapacity($capacity, $count);

            /** End Check Capacity **/

            // Select Name Of Class Academic.
            $classes = AppHelper::selectProperty((new ClassAcademic()),  ["id", "name"]);

            // This Function For Handling return To Index Or Edit View Related To Founding $id.
            return AppHelper::CheckFoundingId(
                (new SubjectAcademic),
                $id,
                "This Subject Not Found",
                "subjectAcademic.index",
                "subjectacademic",
                "edit",
                "subject",
                '$subject',
                $classes,
                $checkCapacity
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("subjectAcademic.index");

        }
    }

    /**
     * Update the specified resource in storage.
     * @param SubjectAcademicRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(SubjectAcademicRequest $request, $id)
    {
        try {

            // Find The Subject With $id.
            $subject = AppHelper::FoundWithId($id, (new SubjectAcademic));

            // If $id Not Found.
            if (!$subject) {

                // This Function For Handling Redirecting If Subject Not Found.
                return AppHelper::IfNotFound('This Subject Not Found', "subjectAcademic.index");

            }

            $data = $request->except("_token");

            // Update Data Of This Employee.
            $subject->update($data);

            // This Function For Handling Redirecting To Index View If Employee Has Been Updated Successfully.
            return AppHelper::IfSuccessfully('The Data Of Subject Updated Successfully', "subjectAcademic.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("subjectAcademic.index");

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {

            // Find The Class With $id.
            $subject = AppHelper::FoundWithId($id, (new SubjectAcademic));

            // If $id Not Found.
            if (!$subject) {

                // This Function For Handling Redirecting If Subject Not Found.
                return AppHelper::IfNotFound('This Subject Not Found', "subjectAcademic.index");

            }

            // Delete This Subject.
            $subject->delete();

            // This Function For Handling Redirecting To Index View If Subjects Academic Has Been Deleted Successfully.
            return AppHelper::IfSuccessfully('The Subject Deleted Successfully', "subjectAcademic.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("subjectAcademic.index");

        }
    }

}
