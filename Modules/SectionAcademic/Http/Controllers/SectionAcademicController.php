<?php

namespace Modules\SectionAcademic\Http\Controllers;

// The Basics :-
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

// View :-
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

// Subject Academic Request :-
use Modules\SectionAcademic\Http\Requests\SectionAcademicRequest;

// Class Academic Request :-
use Modules\ClassAcademic\Entities\ClassAcademic;

// Subject Academic Model :-
use Modules\SectionAcademic\Entities\SectionAcademic;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;

class SectionAcademicController extends Controller
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
            $sections = AppHelper::QuerySearch(
                $request,
                ["name", "class_id"],
                "class_id",
                (new SectionAcademic())
            );

            // Redirect To Index View Of Sections Academic With Two Variables.
            return view('sectionacademic::index', compact("sections", "paginationNumber", "classes"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("sectionAcademic.index");

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
                $capacity = AppHelper::capacityClass((new ClassAcademic()), "id", "capacity_sections");

                // Count Of Sections
                $count = AppHelper::countColumnOfProperty($capacity, (new SectionAcademic()), "name", "class_id");

                // Check Capacity
                $checkCapacity = AppHelper::checkCapacity($capacity, $count);

            /** End Check Capacity **/

            // Return With CheckCapacity Variable If Found Class Has Full From Sections.
            return view("sectionacademic::create", compact("classes", "randomNum", "checkCapacity"));

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("sectionAcademic.index");

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param SectionAcademicRequest $request
     * @return RedirectResponse
     */
    public function store(SectionAcademicRequest $request)
    {
        try{

            // Count Of Column Subjects Of Section Academic Table.
            $countOfSections = AppHelper::countColumn((new SectionAcademic()), "class_id", $request, "class_id");

            // Value Of Capacity Sections Row.
            $capacityOfSections = AppHelper::valueRow((new classAcademic()), "capacity_sections", "id", $request, "class_id");

            if($countOfSections < $capacityOfSections) {

                // Get All Requests Except _token.
                $data = $request->except("_token");

                // Create New Section.
                SectionAcademic::create($data);

                // This Function For Handling Redirecting To Index View If Section Academic Has Been Created Successfully.
                return AppHelper::IfSuccessfully("Section Created Successfully", "sectionAcademic.index");

            } else {

                // Return Back If Condition Not Valid.
                return Redirect::back()->with("noCapacity", "Sorry You Can't Add Section To THis Class.");

            }

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("sectionAcademic.index");

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

                // Count Of Sections.
                $count = AppHelper::countColumnOfProperty($capacity, (new SectionAcademic()), "name", "class_id");

                // Check Capacity
                $checkCapacity = AppHelper::checkCapacity($capacity, $count);

            /** End Check Capacity **/

            // Select Name Of Class Academic.
            $classes = AppHelper::selectProperty((new ClassAcademic()),  ["id", "name"]);

            // This Function For Handling return To Index Or Edit View Related To Founding $id.
            return AppHelper::CheckFoundingId(
                (new SectionAcademic),
                $id,
                "This Section Not Found",
                "sectionAcademic.index",
                "sectionacademic",
                "edit",
                "section",
                '$section',
                $classes,
                $checkCapacity
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("sectionAcademic.index");

        }
    }

    /**
     * Update the specified resource in storage.
     * @param SectionAcademicRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(SectionAcademicRequest $request, $id)
    {
        try {

            // Find The Section With $id.
            $section = AppHelper::FoundWithId($id, (new SectionAcademic));

            // If $id Not Found.
            if (!$section) {

                // This Function For Handling Redirecting If Section Not Found.
                return AppHelper::IfNotFound('This Section Not Found', "sectionAcademic.index");

            }

            $data = $request->except("_token");

            // Update Data Of This Section.
            $section->update($data);

            // This Function For Handling Redirecting To Index View If Section Academic Has Been Updated Successfully.
            return AppHelper::IfSuccessfully('The Data Of Section Updated Successfully', "sectionAcademic.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("sectionAcademic.index");

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
            $section = AppHelper::FoundWithId($id, (new SectionAcademic));

            // If $id Not Found.
            if (!$section) {

                // This Function For Handling Redirecting If Section Not Found.
                return AppHelper::IfNotFound('This Section Not Found', "sectionAcademic.index");

            }

            // Delete This Subject.
            $section->delete();

            // This Function For Handling Redirecting To Index View If Sections Academic Has Been Deleted Successfully.
            return AppHelper::IfSuccessfully('The Section Deleted Successfully', "sectionAcademic.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("sectionAcademic.index");

        }
    }
}
