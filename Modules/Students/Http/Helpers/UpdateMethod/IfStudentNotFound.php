<?php


namespace Modules\Students\Http\Helpers\UpdateMethod;

use Illuminate\Support\Facades\Session;

trait IfStudentNotFound
{

    public function IfStudentNotFound() {

        // Display This Message If Error Happened.
        Session::flash('danger', 'This Student Not Found');

        // Redirect To Index View Of Students If Error Happened.
        return redirect()->route("students.index");

    }

}
