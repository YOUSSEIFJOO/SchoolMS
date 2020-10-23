<?php

namespace Modules\StudentsAttendance\Http\Controllers;

// The Basics :-
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Foundation\Application;

// Redirect Of Response :-
use Illuminate\Http\RedirectResponse;

// View Helper Function :-
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

// Model Of StudentAttendance :-
use Modules\StudentsAttendance\Entities\StudentAttendance;

// Model Of Student :-
use Modules\Students\Entities\Student;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;

class StudentsAttendanceController extends Controller
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
            $attendance = AppHelper::QuerySearch($request, ["class", "section", "name", "date"], "date", (new StudentAttendance()));

            // Redirect To Index View Of Students Attendance With Two Variables.
            return view('studentsattendance::index', compact("attendance", "paginationNumber"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("studentsAttendance.index");

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
            $checkAttendance = AppHelper::checkAttendance(["class", "section", "date"], (new StudentAttendance()), $request);

            // Make Query Search.
            $students = AppHelper::QuerySearchCreate((new Student()), ["class", "section"], $request);

            // Redirect To Create View Of Students.
            return view('studentsattendance::create', compact("students", "checkAttendance"));

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("studentsAttendance.index");

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

            // This Function For Handel Request Arrays Of Student Attendance.
            $data = AppHelper::HandelRequestArrays($request);

            // Create New Students Attendance.
            StudentAttendance::insert($data);

            // This Function For Handling Redirecting To Index View If Students Attendance Has Been Created Successfully.
            return AppHelper::IfSuccessfully('Students Attendance Created Successfully', "studentsAttendance.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("studentsAttendance.index");

        }
    }
}
