<?php

namespace Modules\Teachers\Http\Helpers\IndexMethod;

trait PaginationNumber
{
    // Set THe Number Of Pagination.
    private $paginateNum = 4;

    // This Function For Return The Pagination Number.
    public function paginationNumber() {
        return $this->paginateNum;
    }
}
