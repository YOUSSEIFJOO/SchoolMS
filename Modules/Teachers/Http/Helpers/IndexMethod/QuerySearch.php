<?php


namespace Modules\Teachers\Http\Helpers\IndexMethod;

use Modules\Teachers\Entities\Teacher;

trait QuerySearch
{

    // This Function For Handling The Query Of Selection, Search And OrderBy.
    public function QuerySearch($request) {
        return Teacher::selection()->orderBy("class", "desc")->where
            ([
                ['class', 'LIKE', '%' . $request->class . '%'],
                ['section', 'LIKE', '%' . $request->section . '%'],
                ['name', 'LIKE', '%' . $request->name . '%'],
                ['designation', 'LIKE', '%' . $request->designation . '%']
            ])->paginate($this->paginateNum);
    }

}
