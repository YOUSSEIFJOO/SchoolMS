<?php

namespace Modules\Employees\Http\Controllers;

// The Basics :-
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

// File :-
use Illuminate\Support\Facades\File;

// View :-
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

// Employee Request :-
use Modules\Employees\Http\Requests\EmployeeRequest;

// Employee Model :-
use Modules\Employees\Entities\Employee;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;

class EmployeesController extends Controller
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
            $employees = AppHelper::QuerySearch($request, ["name", "designation"], "name", (new Employee));

            // Redirect To Index View Of Employees With Two Variables.
            return view('employees::index', compact("employees", "paginationNumber"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employees.index");

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        try {

            // Redirect To Create View Of Employees.
            return view('employees::create');

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employees.index");

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param EmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeRequest $request)
    {
        try{

            // Store Hash Name Of Photo If Found.
            $data = AppHelper::StorePhotoIfFound($request, ["_token", "photo", "time"], "employees");

            // Create New Employee.
            Employee::create($data);

            // This Function For Handling Redirecting To Index View If Employee Has Been Created Successfully.
            return AppHelper::IfSuccessfully("Employee Created Successfully", "employees.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employees.index");

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
                    (new Employee),
                    $id,
                    "This Employee Not Found",
                    "employees.index",
                    "employees",
                    "show",
                    "employee",
                    '$employee'
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employees.index");

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
                (new Employee),
                $id,
                "This Employee Not Found",
                "employees.index",
                "employees",
                "edit",
                "employee",
                '$employee'
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employees.index");

        }
    }

    /**
     * Update the specified resource in storage.
     * @param EmployeeRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(EmployeeRequest $request, $id)
    {
        try {

            // Find The Employee With $id.
            $employee = AppHelper::FoundWithId($id, (new Employee));

            // If $id Not Found.
            if (!$employee) {

                // This Function For Handling Redirecting If Employee Not Found.
                return AppHelper::IfNotFound('This Employee Not Found', "employees.index");

            }

            // Handel Delete Old Photo And Store New Photo.
            $data = AppHelper::DeleteStorePhotoIfFound((new Employee), $id, $request, ["_token", "photo", "time"], "employees");

            // Update Data Of This Employee.
            $employee->update($data);

            // This Function For Handling Redirecting To Index View If Employee Has Been Updated Successfully.
            return AppHelper::IfSuccessfully('The Data Of Employee Updated Successfully', "employees.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employees.index");

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

            // Find The Employee With $id.
            $employee = AppHelper::FoundWithId($id, (new Employee));

            // If $id Not Found.
            if (!$employee) {

                // This Function For Handling Redirecting If Employee Not Found.
                return AppHelper::IfNotFound('This Employee Not Found', "employees.index");

            }

            // Get The Path Photo Of This Employee.
            $file = public_path() . "\images\\employees\\" . $employee->time;

            // Delete The Folder Of Photo For This Employee.
            File::deleteDirectory($file);

            // Delete This Employee.
            $employee->delete();

            // This Function For Handling Redirecting To Index View If Employee Has Been Deleted Successfully.
            return AppHelper::IfSuccessfully('The Employee Deleted Successfully', "employees.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("employees.index");

        }
    }
}
