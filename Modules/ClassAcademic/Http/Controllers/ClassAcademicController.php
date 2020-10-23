<?php

namespace Modules\ClassAcademic\Http\Controllers;

// The Basics :-
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

// View :-
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

// Class Academic Request :-
use Modules\ClassAcademic\Http\Requests\ClassAcademicRequest;

// Class Academic Model :-
use Modules\ClassAcademic\Entities\ClassAcademic;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;

class ClassAcademicController extends Controller
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

            // Make Query Search.
            $classes = AppHelper::QuerySearch(
                $request,
                ["name"],
                "capacity_sections",
                (new ClassAcademic())
            );

            // Redirect To Index View Of Classes Academic With Two Variables.
            return view('classacademic::index', compact("classes", "paginationNumber"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("classAcademic.index");

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        try {

            // Redirect To Create View Of Class Academic.
            return view('classacademic::create');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("classAcademic.index");

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param ClassAcademicRequest $request
     * @return RedirectResponse
     */
    public function store(ClassAcademicRequest $request)
    {
        try{

            // Get All Requests Except _token.
            $data = $request->except("_token");

            // Create New Class.
            ClassAcademic::create($data);

            // This Function For Handling Redirecting To Index View If Classes Academic Has Been Created Successfully.
            return AppHelper::IfSuccessfully("Class Created Successfully", "classAcademic.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("classAcademic.index");

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

            // This Function For Handling return To Index Or Edit View Related To Founding $id.
            return AppHelper::CheckFoundingId(
                (new ClassAcademic),
                $id,
                "This Class Not Found",
                "classAcademic.index",
                "classacademic",
                "edit",
                "class",
                '$class'
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("classAcademic.index");

        }
    }

    /**
     * Update the specified resource in storage.
     * @param ClassAcademicRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ClassAcademicRequest $request, $id)
    {
        try {

            // Find The Class With $id.
            $class = AppHelper::FoundWithId($id, (new ClassAcademic));

            // If $id Not Found.
            if (!$class) {

                // This Function For Handling Redirecting If Class Not Found.
                return AppHelper::IfNotFound('This Class Not Found', "classAcademic.index");

            }

            $data = $data = $request->except("_token");

            // Update Data Of This Employee.
            $class->update($data);

            // This Function For Handling Redirecting To Index View If Employee Has Been Updated Successfully.
            return AppHelper::IfSuccessfully('The Data Of Class Updated Successfully', "classAcademic.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("classAcademic.index");

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
            $class = AppHelper::FoundWithId($id, (new ClassAcademic));

            // If $id Not Found.
            if (!$class) {

                // This Function For Handling Redirecting If Class Not Found.
                return AppHelper::IfNotFound('This Class Not Found', "classAcademic.index");

            }

            // Delete This Class.
            $class->delete();

            // This Function For Handling Redirecting To Index View If Classes Academic Has Been Deleted Successfully.
            return AppHelper::IfSuccessfully('The Class Deleted Successfully', "classAcademic.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("classAcademic.index");

        }
    }
}
