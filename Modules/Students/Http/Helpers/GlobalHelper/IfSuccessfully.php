<?php


namespace Modules\Students\Http\Helpers\GlobalHelper;

use Illuminate\Support\Facades\Session;

trait IfSuccessfully
{
    public function IfSuccessfully($message) {

        // Display This Message If Student Created Successfully.
        Session::flash('success', $message);

        // Redirect If Success To Index Of Student.
        return redirect()->route("students.index");

    }
}
