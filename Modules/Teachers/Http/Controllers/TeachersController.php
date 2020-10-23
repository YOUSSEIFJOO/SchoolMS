<?php

namespace Modules\Teachers\Http\Controllers;

// The Basics :-
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

// File :-
use Illuminate\Support\Facades\File;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;

// Teacher Request :-
use Modules\Teachers\Http\Requests\TeacherRequest;

// View :-
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

// Teacher Model :-
use Modules\Teachers\Entities\Teacher;


class TeachersController extends Controller
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
            $teachers = AppHelper::QuerySearch($request, ["class", "section", "name", "designation"], "name", (new Teacher));

            // Redirect To Index View Of Teachers With Two Variables.
            return view('teachers::index', compact("teachers", "paginationNumber"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachers.index");

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        try {

            // Redirect To Create View Of Teachers.
            return view('teachers::create');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachers.index");

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param TeacherRequest $request
     * @return RedirectResponse
     */
    public function store(TeacherRequest $request)
    {
        try{

            // Store Hash Name Of Photo If Found.
            $data = AppHelper::StorePhotoIfFound($request, ["_token", "photo", "time"], "teachers");

            // Create New Teacher.
            Teacher::create($data);

            // This Function For Handling Redirecting To Index View If Teacher Has Been Created Successfully.
            return AppHelper::IfSuccessfully('Teacher Created Successfully', "teachers.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachers.index");

        }
    }

    /**
     * Show the specified resource.
     * @param $id
     * @return RedirectResponse
     */
    public function show($id)
    {
        try {

            // This Function For Handling return To Index Or Edit View Related To Founding $id.
            return AppHelper::CheckFoundingId(
                (new Teacher),
                $id,
                "This Teacher Not Found",
                "students.index",
                "teachers",
                "show",
                "teacher",
                '$teacher'
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachers.index");

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
                (new Teacher),
                $id,
                "This Teacher Not Found",
                "students.index",
                "teachers",
                "edit",
                "teacher",
                '$teacher'
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachers.index");

        }
    }

    /**
     * Update the specified resource in storage.
     * @param TeacherRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(TeacherRequest $request, $id)
    {
        try {

            // Find The Teacher With $id.
            $teacher = AppHelper::FoundWithId($id, (new Teacher));

            // If $id Not Found.
            if (!$teacher) {

                // This Function For Handling Redirecting If Teacher Not Found.
                return AppHelper::FoundWithId($id, (new Teacher));

            }

            // Handel Delete Old Photo And Store New Photo.
            $data = AppHelper::DeleteStorePhotoIfFound((new Teacher), $id, $request, ["_token", "photo", "time"], "teachers");

            // Update Data Of This Teacher.
            $teacher->update($data);

            // This Function For Handling Redirecting To Index View If Teacher Has Been Updated Successfully.
            return AppHelper::IfSuccessfully('The Data Of Teacher Updated Successfully', "teachers.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachers.index");

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

            // Find The Teacher With $id.
            $teacher = AppHelper::FoundWithId($id, (new Teacher));

            // If $id Not Found.
            if (!$teacher) {

                // This Function For Handling Redirecting If Teacher Not Found.
                return AppHelper::IfNotFound('This Teacher Not Found', "teachers.index");

            }

            // Get The Path Photo Of This Teacher.
            $file = public_path() . "\images\\teachers\\" . $teacher->time;

            // Delete The Folder Of Photo For This Teacher.
            File::deleteDirectory($file);

            // Delete This Teacher.
            $teacher->delete();

            // This Function For Handling Redirecting To Index View If Teacher Has Been Deleted Successfully.
            return AppHelper::IfSuccessfully('The Teacher Deleted Successfully', "teachers.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachers.index");

        }
    }
}
