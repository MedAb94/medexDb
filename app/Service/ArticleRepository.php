<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\stock\Article;
use App\Service\Contract\Repository;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository implements Repository
{
    public function findAll(): Collection
    {
        return Article::all();
    }

    public function findById(int $id): Article
    {
        return Article::where('id', '=', $id)->first();
    }
}
