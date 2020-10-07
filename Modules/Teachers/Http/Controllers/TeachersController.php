<?php

namespace Modules\Teachers\Http\Controllers;

// The Basics :-
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Teachers\Http\Requests\TeacherRequest;

// Helpers :-

    // Global Helper :-
    use Illuminate\View\View;
    use Modules\Teachers\Entities\Teacher;
    use Modules\Teachers\Http\Helpers\GlobalHelper\CheckFoundingId;
    use Modules\Teachers\Http\Helpers\GlobalHelper\FoundWithId;
    use Modules\Teachers\Http\Helpers\GlobalHelper\IfSuccessfully;
    use Modules\Teachers\Http\Helpers\GlobalHelper\IfUnexpectedError;

    // Index Method :-
    use Modules\Teachers\Http\Helpers\IndexMethod\PaginationNumber;
    use Modules\Teachers\Http\Helpers\IndexMethod\QuerySearch;

    // Store Method :-
    use Modules\Teachers\Http\Helpers\StoreMethod\StorePhotoIfFound;

    // Update Method :-
    use Modules\Teachers\Http\Helpers\UpdateMethod\DeleteStorePhotoIfFound;
    use Modules\Teachers\Http\Helpers\UpdateMethod\IfTeacherNotFound;

class TeachersController extends Controller
{
    use
        CheckFoundingId, FoundWithId, IfSuccessfully, IfUnexpectedError, PaginationNumber,
        QuerySearch, StorePhotoIfFound,DeleteStorePhotoIfFound, IfTeacherNotFound;

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
            $teachers = $this->QuerySearch($request);

            // Redirect To Index View Of Teachers With Two Variables.
            return view('teachers::index', compact("teachers", "paginationNumber"));

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

            // Redirect To Create View Of Teachers.
            return view('teachers::create');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

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
            $data = $this->StorePhotoIfFound($request);

            // Create New Teacher.
            Teacher::create($data);

            // This Function For Handling Redirecting To Index View If Teacher Has Been Created Successfully.
            return $this->IfSuccessfully('Teacher Created Successfully');

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
     * @return RedirectResponse
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
     * @param TeacherRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(TeacherRequest $request, $id)
    {
        try {

            // Find The Teacher With $id.
            $teacher = $this->FoundWithId($id);

            // If $id Not Found.
            if (!$teacher) {

                // This Function For Handling Redirecting If Teacher Not Found.
                return $this->IfTeacherNotFound();

            }

            // Handel Delete Old Photo And Store New Photo.
            $data = $this->DeleteStorePhotoIfFound($request, $id);

            // Update Data Of This Teacher.
            $teacher->update($data);

            // This Function For Handling Redirecting To Index View If Teacher Has Been Updated Successfully.
            return $this->IfSuccessfully('The Data Of Teacher Updated Successfully');

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

            // Find The Teacher With $id.
            $teacher = $this->FoundWithId($id);

            // If $id Not Found.
            if (!$teacher) {

                // This Function For Handling Redirecting If Teacher Not Found.
                return $this->IfTeacherNotFound();

            }

            // Get The Path Photo Of This Teacher.
            $file = public_path() . "\images\\teachers\\" . $teacher->photo;

            // Delete The Photo For This Teacher.
            unlink($file);

            // Delete This Teacher.
            $teacher->delete();

            // This Function For Handling Redirecting To Index View If Teacher Has Been Deleted Successfully.
            return $this->IfSuccessfully('The Teacher Deleted Successfully');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return $this->IfUnexpectedError();

        }
    }
}
