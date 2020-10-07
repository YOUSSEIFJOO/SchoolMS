<?php


namespace Modules\Students\Http\Helpers\IndexMethod;

use Modules\Students\Entities\Student;

trait QuerySearch
{

    // This Function For Handling The Query Of Selection, Search And OrderBy.
    public function QuerySearch($request) {
        return Student::selection()->orderBy("class", "desc")->where
            ([
                ['class', 'LIKE', '%' . $request->class . '%'],
                ['section', 'LIKE', '%' . $request->section . '%'],
                ['name', 'LIKE', '%' . $request->name . '%']
            ])->paginate($this->paginateNum);
    }

}
