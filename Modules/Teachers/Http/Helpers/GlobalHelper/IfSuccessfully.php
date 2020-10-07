<?php

namespace Modules\Teachers\Http\Helpers\GlobalHelper;

use Illuminate\Support\Facades\Session;

trait IfSuccessfully
{
    public function IfSuccessfully($message) {

        // Display This Message If Teacher Created Successfully.
        Session::flash('success', $message);

        // Redirect If Success To Index Of Teacher.
        return redirect()->route("teachers.index");

    }
}
