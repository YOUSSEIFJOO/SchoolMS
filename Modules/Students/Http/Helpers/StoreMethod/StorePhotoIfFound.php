<?php


namespace Modules\Students\Http\Helpers\StoreMethod;


use Illuminate\Support\Facades\Hash;

trait StorePhotoIfFound
{

    public function StorePhotoIfFound($request) {

        // Handle All Requests Except _token And Photo.
        $data = $request->except("_token", "photo");

        if($request->hasfile('photo')) {

            // Handle Hash Name Of Photo.
            $hashNamePhoto = Hash::make($request->file('photo')->getClientOriginalName()) . time();

            // Handel The Extension Of Photo.
            $extensionPhoto = $request->file('photo')->getClientOriginalExtension();

            // Handel The Hash Name Of Photo And The Extension.
            $namePhoto = $hashNamePhoto . "." . $extensionPhoto;

            // Save Image In The Path.
            $request->file('photo')->storeAs("students", $namePhoto, "students");

            // Add Hash Name Of Photo To Data Array.
            $data["photo"] = $namePhoto;

            return $data;

        }

    }

}
