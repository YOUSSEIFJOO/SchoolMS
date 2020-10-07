<?php

namespace Modules\Teachers\Http\Helpers\UpdateMethod;

use Illuminate\Support\Facades\Hash;

trait DeleteStorePhotoIfFound
{

    public function DeleteStorePhotoIfFound($request, $id) {

        // Finding The Teacher With $id.
        $teacher = $this->FoundWithId($id);

        // Except Photo Request To Handel Delete And Store Operation.
        $data = $request->except("_token", "photo");

        // If Request Has Photo.
        if($request->hasfile("photo")) {

            // Get The Path Photo Of This Teacher.
            $file = public_path() . "\images\\teachers\\" . $teacher->photo;

            // Delete The Photo For This Student.
            unlink($file);

            // Handle Hash Name Of Photo.
            $hashNamePhoto = Hash::make($request->file('photo')->getClientOriginalName()) . time();

            // Handel The Extension Of Photo.
            $extensionPhoto = $request->file('photo')->getClientOriginalExtension();

            // Handel The Hash Name Of Photo And The Extension.
            $namePhoto = $hashNamePhoto . "." . $extensionPhoto;

            // Save Image In The Path.
            $request->file('photo')->storeAs("teachers", $namePhoto, "teachers");

            // Add Photo Request To $data Of Requests
            $data["photo"] = $namePhoto;

        }

        // $data That Have All Requests.
        return $data;

    }

}
