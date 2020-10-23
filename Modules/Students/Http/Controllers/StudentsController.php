<?php

namespace Modules\Students\Http\Controllers;

// The Basics :-
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;

// Redirect Of Response :-
use Illuminate\Http\RedirectResponse;

// View Helper Function :-
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

// Model Of Student :-
use Modules\ClassAcademic\Entities\ClassAcademic;
use Modules\SectionAcademic\Entities\SectionAcademic;
use Modules\Students\Entities\Student;

// Requests :-
use Modules\Students\Http\Requests\StudentRequest;

// Class Helper :-
use Modules\Core\Http\Helper\AppHelper;
use Symfony\Component\Console\Input\Input;

class StudentsController extends Controller
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
            $students = AppHelper::QuerySearch($request, ["class_id", "section_id", "name"], "class_id", (new Student));

            // Select Name Of Class Academic.
            $classes = AppHelper::selectProperty((new ClassAcademic()),  ["id", "name"]);

            // Select Name Of Class Academic.
            $sections = AppHelper::selectProperty((new SectionAcademic()),  ["id", "name"]);

            // Redirect To Index View Of Students With Two Variables.
            return view('students::index', compact("students", "paginationNumber", "classes", "sections"));

        } catch (Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("students.index");

        }
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function selectSection(Request $request){

        return json_decode(SectionAcademic::where("class_id", $request->class_id)->get());

    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        try {

            // Select Name Of Class Academic.
            $classes = AppHelper::selectProperty((new ClassAcademic()),  ["id", "name"]);

            // Select Name Of Section Academic.
            $sections = AppHelper::selectProperty((new SectionAcademic()),  "id");

            /** Start Check Capacity **/

                // Capacity Of Students.
                $capacity = AppHelper::capacityClass((new SectionAcademic()), "id", "capacity_students");

                // Count Of Students
                $count = AppHelper::countColumnOfProperty($capacity, (new Student()), "section_id", "section_id");

                // Check Capacity
                $checkCapacity = AppHelper::checkCapacity($capacity, $count);

                foreach($sections as $section) {

                    if($section->id === $checkCapacity) {

                        dd($section->id);

                    }

                }

            /** End Check Capacity **/

            // Redirect To Create View Of Students.
            return view('students::create', compact("classes","sections", "checkCapacity"));

        } catch(Exception $e) {

            return $e;

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("students.index");

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

            // Count Of Column Students Of Student Table.
            $countOfStudents = AppHelper::countColumn((new Student()), "section_id", $request, "section_id");

            // Value Of Capacity Sections Row.
            $capacityOfSections = AppHelper::valueRow((new SectionAcademic()), "capacity_students", "id", $request, "section_id");

            if($countOfStudents < $capacityOfSections) {

                // Store Hash Name Of Photo If Found.
                $data = AppHelper::StorePhotoIfFound($request, ["_token", "photo", "time"], "students");

                // Create New Student.
                Student::create($data);

                // This Function For Handling Redirecting To Index View If Student Has Been Created Successfully.
                return AppHelper::IfSuccessfully('Student Created Successfully', "students.index");

            } else {

                // Return Back If Condition Not Valid.
                return Redirect::back()->with("noCapacity", "Sorry You Can't Add Student To This Section.");


            }

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("students.index");

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
                (new Student),
                $id,
                "This Student Not Found",
                "students.index",
                "students",
                "show",
                "student",
                '$student'
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("students.index");

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

            // Select Name Of Class Academic.
            $classes = AppHelper::selectProperty((new ClassAcademic()),  ["id", "name"]);

            // Select Name Of Section Academic.
            $sections = AppHelper::selectProperty((new SectionAcademic()),  ["id", "name"]);

            /** Start Check Capacity **/

                // Capacity Of Students.
                $capacity = AppHelper::capacityClass((new SectionAcademic()), "id", "capacity_students");

                // Count Of Students
                $count = AppHelper::countColumnOfProperty($capacity, (new Student()), "section_id", "section_id");

                // Check Capacity
                $checkCapacity = AppHelper::checkCapacity($capacity, $count);

            /** End Check Capacity **/

//            compact("classes", "sections", "checkCapacity")

            // This Function For Handling return To Index Or Edit View Related To Founding $id.
            return AppHelper::CheckFoundingId(
                (new Student),
                $id,
                "This Student Not Found",
                "students.index",
                "students",
                "edit",
                "student",
                '$student',
                $classes,
                $checkCapacity,
                $sections
            );

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("students.index");

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
            $student = AppHelper::FoundWithId($id, (new Student));

            // If $id Not Found.
            if (!$student) {

                // This Function For Handling Redirecting If Student Not Found.
                return AppHelper::IfNotFound('This Student Not Found', "students.index");

            }

            // Handel Delete Old Photo And Store New Photo.
            $data = AppHelper::DeleteStorePhotoIfFound((new Student), $id, $request, ["_token", "photo", "time"], "students");

            // Update Data Of This Student.
            $student->update($data);

            // This Function For Handling Redirecting To Index View If Student Has Been Updated Successfully.
            return AppHelper::IfSuccessfully('The Data Of Student Updated Successfully', "students.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("students.index");

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
            $student = AppHelper::FoundWithId($id, (new Student));

            // If $id Not Found.
            if (!$student) {

                // This Function For Handling Redirecting If Student Not Found.
                return AppHelper::IfNotFound('This Student Not Found', "students.index");

            }

            // Get The Path Folder Of Photo Of This Student.
            $file = public_path() . "\images\students\\" . $student->time;

            // Delete The Folder Of Photo For This Student.
            File::deleteDirectory($file);

            // Delete This Student.
            $student->delete();

            // This Function For Handling Redirecting To Index View If Student Has Been Deleted Successfully.
            return AppHelper::IfSuccessfully('The Student Deleted Successfully', "students.index");

        } catch(Exception $e) {

            // This Function For Handling If Unexpected Error Happened.
            return AppHelper::IfUnexpectedError("students.index");

        }
    }
}
