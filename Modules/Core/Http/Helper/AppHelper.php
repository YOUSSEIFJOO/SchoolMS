<?php

namespace Modules\Core\Http\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AppHelper
{
    // Set THe Number Of Pagination.
    const PAGINATE_NUMBER = 20;

    // Query Search Of Index Method;
    public static function QuerySearch($request, $properties, $orderBy, $instance) {

        return $instance->selection()->orderBy($orderBy, "desc")->where(function($q) use ($request, $properties) {

            foreach($properties as $property){

                $q->where($property, "like", "%" . $request->$property . "%");

            }

        })->paginate(self::PAGINATE_NUMBER);

    }


    // If Unexpected Error Happen Redirect To $routeName.
    public static function IfUnexpectedError($routeName) {
        // Display This Message If Error Happened.
        Session::flash('danger', 'Something Went Wrong, Please Try Again');

        // Redirect To Index View Of Employees If Error Happened.
        return redirect()->route($routeName);
    }

    // All Methods Of Store Photo If Found In Request.
    public static function StorePhotoIfFound($request, $excepts, $diskSave) {

        // Handle All Requests Except _token And Photo And Time.
        $data = $request->except($excepts);

        if($request->hasfile('photo')) {

            // Handle Hash Name Of Photo.
            $hashNamePhoto = Str::random(15). "_" . time() . "_" . $request->file('photo')->getClientOriginalName();

            // Save Image In The Path.
            $request->file('photo')->storeAs(time(), $hashNamePhoto, $diskSave);

            // Add The Value Of Request Time.
            $data["time"] = time();

            // Add Hash Name Of Photo To Data Array.
            $data["photo"] = $hashNamePhoto;

            return $data;

        }

    }

    // Redirect To $routeName If Successfully Store Method.
    public static function IfSuccessfully($message, $routeName) {

        // Display This Message If Create Method Successfully.
        Session::flash('success', $message);

        // Redirect If Success To Index Of Route.
        return redirect()->route($routeName);

    }

    // Check Founding Id For Show Data Of The Element.
    public static function CheckFoundingId($instance, $id, $messageError, $routeName, $moduleName, $view, $elementName, $varName, $classes = NULL, $checkCapacity = NULL, $sections = NULL) {

        // This Function For Founding Who Have $id.
        $varName = $instance->find($id);

        // Check If This Element Not Found.
        if (!$varName) {

            // Display This Message If Error Happened.
            Session::flash('danger', $messageError);

            // Redirect To Index View If Error Happened.
            return redirect()->route($routeName);

        } else {

            // Redirect To Show View If $id Has Been Found.
            return view("$moduleName::$view", [$elementName => $varName, "classes" => $classes, "checkCapacity" => $checkCapacity, "sections" => $sections]);

        }
    }

    // Check Founding Who Have $id
    public static function FoundWithId($id, $instance)
    {
        // Get The Element Who Have $id.
        return $instance->find($id);
    }

    // If Error Happen During Search About Id Of Update Method.
    public static function IfNotFound($message, $routeName) {

        // Display This Message If Error Happened.
        Session::flash('danger', $message);

        // Redirect To Index View If Error Happened.
        return redirect()->route($routeName);

    }

    // Delete Old Photo And Save New Photo.
    public static function DeleteStorePhotoIfFound($instance, $id, $request, $excepts, $disk) {

        // Finding Who Have $id.
        $element = $instance->find($id);

        // Except Photo Request To Handel Delete And Store Operation.
        $data = $request->except($excepts);

        // If Request Has Photo.
        if($request->hasfile("photo")) {

            // Get The Path Photo Of The Element.
            $file = public_path() . "\images\\employees\\" . $element->time;

            // Delete The Photo For This Element.
            File::deleteDirectory($file);

            // Handle Hash Name Of Photo.
            $hashNamePhoto = Str::random(15). "_" . time() . "_" . $request->file('photo')->getClientOriginalName();

            // Save Image In The Path.
            $request->file('photo')->storeAs(time(), $hashNamePhoto, $disk);

            // Update The Value Of Request Time
            $data["time"] = time();

            // Update Photo Request To $data Of Requests
            $data["photo"] = $hashNamePhoto;

        }

        // $data That Have All Requests.
        return $data;

    }

    // This Function For Handling The Query Of Where For Check Attendance.
    public static function checkAttendance($properties, $instance, $request) {

        return $instance->where(function($q) use ($request, $properties) {

            foreach($properties as $property){

                $q->where($property, $request->$property);

            }

        })->first();

    }

    // This Function For Handling The Query Of Selection, Search And OrderBy.
    public static function QuerySearchCreate($instance, $properties, $request) {

        return $instance->where(function($q) use ($request, $properties) {

            foreach($properties as $property){

                $q->where($property,  'LIKE', '%' . $request->$property . '%');

            }

        })->get();

    }

    // Handle Array Of Values Come From Request.
    public static function HandelRequestArrays($request) {

        // This Empty Array For Put In It Arrays From Request Arrays Of Student Attendance.
        $data = [];

        // For Loop For Looping In Arrays That Come From Student Attendance.
        for($i = 0; $i < count($request->name); $i++) {

            array_push($data, array(

                "name"      => $request->name[$i],
                "class"     => $request->class[$i],
                "section"   => $request->section[$i],
                "date"      => $request->date[$i],
                "status"    => $request->status[$i]

            ));
        }

        return $data;
    }

    // This Function For Handling The Query Of Selection.
    public static function QueryCreate($instance, $request) {

        return $instance->select("name", "designation")->where('name', $request->name)->first();

    }

    // This Function For Get The Name.
    public static function selectProperty($instance, $property) {

        return $instance->select($property)->get();

    }

    // Generate Random Number.
    public static function randNumber() {

        return rand();

    }

    // Count Of Column.
    public static function countColumn($instance, $property, $request, $requestProperty) {

        return $instance->where($property, $request->$requestProperty)->count();

    }

    // Value Of Row.
    public static function valueRow($instance, $property, $propertyWhere, $request, $requestProperty) {

        $resultQuery = $instance->select($property)->where($propertyWhere, $request->$requestProperty)->first();

        return $resultQuery->$property;

    }

    // Capacity Of Class.
    public static function capacityClass($instance, $property1, $property2) {

        $classesName = $instance->select($property1, $property2)->get();

        $capacity = [];

        foreach($classesName as $className) {

            $capacity[$className->$property1] = $className->$property2;

        }

        return $capacity;

    }

    // Count Of Subjects.
    public static function countColumnOfProperty($capacity, $instance, $propertySelect, $property) {

        $count = [];

        foreach($capacity as $key => $value) {

            $count[$key] = $instance->select($propertySelect)->where($property, $key)->count();

        }

        return $count;

    }

    public static function checkCapacity($capacity, $count) {

        $checkCapacity = [];

        foreach($capacity as $keyCA => $valueCA) {

            foreach($count as $keyCO => $valueCO) {

                if($keyCA === $keyCO) {

                    if($valueCO >= $valueCA) {

                        $checkCapacity[] = $keyCA;

                    }

                }

            }

        }

        return $checkCapacity;

    }

    // Name Of Class From Class Academic Table From Subject Academic By Relationship.
    public static function ClassName($instance, $id, $anotherTable, $property) {

        return $instance->find($id)->$anotherTable->$property;

    }

}
