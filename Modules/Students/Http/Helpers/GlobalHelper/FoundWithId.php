<?php


namespace Modules\Students\Http\Helpers\GlobalHelper;

use Modules\Students\Entities\Student;

trait FoundWithId
{

    public function FoundWithId($id)
    {

        // Get The Student That Have $id.
        return Student::find($id);

    }

}
