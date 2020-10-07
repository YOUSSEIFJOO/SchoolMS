<?php

namespace Modules\Teachers\Http\Helpers\GlobalHelper;

use Illuminate\Support\Facades\Session;

trait IfUnexpectedError
{

    public function IfUnexpectedError() {

        // Display This Message If Error Happened.
        Session::flash('danger', 'Something Went Wrong, Please Try Again');

        // Redirect To Index View Of Teachers If Error Happened.
        return redirect()->route("teachers.index");

    }

}
