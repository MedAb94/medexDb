<?php

declare(strict_types=1);

namespace App\Service\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Repository
{
    public function findAll(): Collection;

    public function findById(int $id): mixed;
}
