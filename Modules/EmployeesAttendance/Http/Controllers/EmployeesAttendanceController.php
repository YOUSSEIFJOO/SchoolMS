<?php

namespace Modules\EmployeesAttendance\Http\Controllers;

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
use Modules\EmployeesAttendance\Entities\EmployeeAttendance;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;

// Model Of Employee :-
use Modules\Employees\Entities\Employee;


class EmployeesAttendanceController extends Controller
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
            $attendance = AppHelper::QuerySearch($request, ["name", "designation", "date"], "date", (new EmployeeAttendance()));

            // Redirect To Index View Of Employees Attendance With Two Variables.
            return view('employeesattendance::index', compact("attendance", "paginationNumber"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employeesAttendance.index");

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

            // Check If Employees Attendance Take Before Or Not.
            $checkAttendance = AppHelper::checkAttendance(["name", "date"], (new EmployeeAttendance()), $request);

            // This Function For Select Only Name Of Employee.
            $employeesNames = AppHelper::selectName((new Employee));

            // Make Query Search.
            $employee = AppHelper::QueryCreate((new Employee()), $request);

            // Redirect To Create View Of Employees Attendance Of Create.
            return view('employeesattendance::create', compact("employeesNames", "employee", "checkAttendance"));

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employeesAttendance.index");

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

            // Create New Employee Attendance.
            EmployeeAttendance::create($data);

            // This Function For Handling Redirecting To Index View If Employee Attendance Has Been Created Successfully.
            return AppHelper::IfSuccessfully('Employee Attendance Created Successfully', "employeesAttendance.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employeesAttendance.index");

        }

    }
}
