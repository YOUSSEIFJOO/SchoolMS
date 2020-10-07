<?php

namespace Modules\Students\Http\Controllers;

// The Basics :-
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

// Redirect Of Response.
use Illuminate\Http\RedirectResponse;

// View Helper Function.
use Illuminate\View\View;

// Model Of Student.
use Modules\Students\Entities\Student;

// Requests :-
use Modules\Students\Http\Requests\StudentRequest;

// Helpers :-

    // Global Helper :-
    use Modules\Students\Http\Helpers\GlobalHelper\CheckFoundingId;
    use Modules\Students\Http\Helpers\GlobalHelper\FoundWithId;
    use Modules\Students\Http\Helpers\GlobalHelper\IfSuccessfully;
    use Modules\Students\Http\Helpers\GlobalHelper\IfUnexpectedError;

    // Index Method :-
    use Modules\Students\Http\Helpers\IndexMethod\PaginationNumber;
    use Modules\Students\Http\Helpers\IndexMethod\QuerySearch;

    // Store Method :-
    use Modules\Students\Http\Helpers\StoreMethod\StorePhotoIfFound;

    // Update Method :-
    use Modules\Students\Http\Helpers\UpdateMethod\DeleteStorePhotoIfFound;
    use Modules\Students\Http\Helpers\UpdateMethod\IfStudentNotFound;

class StudentsController extends Controller
{

    use
        CheckFoundingId, FoundWithId, IfSuccessfully, IfUnexpectedError, PaginationNumber,
        QuerySearch, StorePhotoIfFound,DeleteStorePhotoIfFound, IfStudentNotFound;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function index(Request $request)
    {
        try {

            // Get The Pagination Number.
            $paginationNumber = $this->paginationNumber();

            // Make Query Search.
            $students = $this->QuerySearch($request);

            // Redirect To Index View Of Students With Two Variables.
            return view('students::index', compact("students", "paginationNumber"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        try {

            // Redirect To Create View Of Students.
            return view('students::create');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param StudentRequest $request
     * @return RedirectResponse
     */
    public function store(StudentRequest $request)
    {
        try{

            // Store Hash Name Of Photo If Found.
            $data = $this->StorePhotoIfFound($request);

            // Create New Student.
            Student::create($data);

            // This Function For Handling Redirecting To Index View If Student Has Been Created Successfully.
            return $this->IfSuccessfully('Student Created Successfully');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

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
            return $this->CheckFoundingId($id, "show");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        try {

            // This Function For Handling return To Index Or Edit View Related To Founding $id.
            return $this->CheckFoundingId($id, "edit");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

        }
    }

    /**
     * Update the specified resource in storage.
     * @param StudentRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(StudentRequest $request, $id)
    {
        try {

            // Find The Student With $id.
            $student = $this->FoundWithId($id);

            // If $id Not Found.
            if (!$student) {

                // This Function For Handling Redirecting If Student Not Found.
                return $this->IfStudentNotFound();

            }

            // Handel Delete Old Photo And Store New Photo.
            $data = $this->DeleteStorePhotoIfFound($request, $id);

            // Update Data Of This Student.
            $student->update($data);

            // This Function For Handling Redirecting To Index View If Student Has Been Updated Successfully.
            return $this->IfSuccessfully('The Data Of Student Updated Successfully');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

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

            // Find The Student With $id.
            $student = $this->FoundWithId($id);

            // If $id Not Found.
            if (!$student) {

                // This Function For Handling Redirecting If Student Not Found.
                return $this->IfStudentNotFound();

            }

            // Get The Path Photo Of This Student.
            $file = public_path() . "\images\students\\" . $student->photo;

            // Delete The Photo For This Student.
            unlink($file);

            // Delete This Student.
            $student->delete();

            // This Function For Handling Redirecting To Index View If Student Has Been Deleted Successfully.
            return $this->IfSuccessfully('The Student Deleted Successfully');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

        }
    }
}
