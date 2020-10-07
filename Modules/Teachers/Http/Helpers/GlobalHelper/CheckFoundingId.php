<?php


namespace Modules\Teachers\Http\Helpers\GlobalHelper;

use Illuminate\Support\Facades\Session;

trait CheckFoundingId
{

    public function CheckFoundingId($id, $view) {

        // This Function For Founding The Teacher That Have $id.
        $teacher = $this->FoundWithId($id);

        // Check If This Student Not Found.
        if (!$teacher) {

            // Display This Message If Error Happened.
            Session::flash('danger', 'This Teacher Not Found');

            // Redirect To Index View Of Teachers If Error Happened.
            return redirect()->route("teachers.index");

        } else {

            // Redirect To Edit View Of Teachers If $id Has Been Found.
            return view("teachers::$view", compact("teacher"));

        }

    }

}
