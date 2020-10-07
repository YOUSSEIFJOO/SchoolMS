<?php

namespace Modules\Teachers\Http\Helpers\GlobalHelper;

use Modules\Teachers\Entities\Teacher;

trait FoundWithId
{

    public function FoundWithId($id)
    {

        // Get The Teacher That Have $id.
        return Teacher::find($id);

    }

}
