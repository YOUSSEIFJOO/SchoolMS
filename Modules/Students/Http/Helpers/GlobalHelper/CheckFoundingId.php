<?php


namespace Modules\Students\Http\Helpers\GlobalHelper;

use Illuminate\Support\Facades\Session;

trait CheckFoundingId
{

    public function CheckFoundingId($id, $view) {

        // This Function For Founding The Student That Have $id.
        $student = $this->FoundWithId($id);

        // Check If This Student Not Found.
        if (!$student) {

            // Display This Message If Error Happened.
            Session::flash('danger', 'This Student Not Found');

            // Redirect To Index View Of Students If Error Happened.
            return redirect()->route("students.index");

        } else {

            // Redirect To Edit View Of Students If $id Has Been Found.
            return view("students::$view", compact("student"));

        }

    }

}
