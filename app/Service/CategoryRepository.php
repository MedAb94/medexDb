<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\stock\Category;
use App\Service\Contract\Repository;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements Repository
{
    public function __construct() {}

    public function findAll(): Collection
    {
        return Category::all();
    }

    public function findById(int $id): Category
    {
        return Category::where('id', '=', $id)->first();
    }
}
