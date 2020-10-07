<?php

namespace Modules\Teachers\Http\Helpers\UpdateMethod;

use Illuminate\Support\Facades\Session;

trait IfTeacherNotFound
{

    public function IfTeacherNotFound() {

        // Display This Message If Error Happened.
        Session::flash('danger', 'This Teacher Not Found');

        // Redirect To Index View Of Teachers If Error Happened.
        return redirect()->route("teachers.index");

    }

}
