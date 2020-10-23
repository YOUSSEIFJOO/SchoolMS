<?php

namespace Modules\TeachersAttendance\Http\Controllers;

// The Basics :-
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

// Redirect Of Response :-
use Illuminate\Http\RedirectResponse;

// View Helper Function :-
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

// Model Of TeacherAttendance :-
use Modules\TeachersAttendance\Entities\TeacherAttendance;

// Model Of Teacher :-
use Modules\Teachers\Entities\Teacher;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;


class TeachersAttendanceController extends Controller
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
            $attendance = AppHelper::QuerySearch($request, ["name", "designation", "date"], "date", (new TeacherAttendance()));

            // Redirect To Index View Of Teachers Attendance With Two Variables.
            return view('teachersattendance::index', compact("attendance", "paginationNumber"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachersAttendance.index");

        }
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function create(Request $request)
    {
        try {

            // Check If Students Attendance Take Before Or Not.
            $checkAttendance = AppHelper::checkAttendance(["name", "date"], (new TeacherAttendance()), $request);

            // Select Name Only From Teacher Model.
            $teachersNames = AppHelper::selectProperty((new Teacher), "name");

            // Make Query Search.
            $teacher = AppHelper::QueryCreate((new Teacher()), $request);

            // Redirect To Create View Of Students.
            return view('teachersattendance::create', compact("teachersNames", "teacher", "checkAttendance"));

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachersAttendance.index");

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {

            // All Requests Except _token.
            $data = $request->except("_token");

            // Create New Teacher Attendance.
            TeacherAttendance::create($data);

            // This Function For Handling Redirecting To Index View If Teacher Attendance Has Been Created Successfully.
            return AppHelper::IfSuccessfully('Teacher Attendance Created Successfully', "teachersAttendance.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("teachersAttendance.index");

        }

    }


}
