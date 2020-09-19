<?php

declare(strict_types=1);

namespace FromHome\Common\Repository;

use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RequestFilterAwareRepositoryInterface
{
    public function filter(Request $request): LengthAwarePaginator;
}
