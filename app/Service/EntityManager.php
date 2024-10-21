<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Database\Eloquent\Model;

class EntityManager
{
    public function persist(Model &$model): void
    {
        $model->save();
    }

    public function remove(Model &$model): void
    {
        $model->delete();
    }
}
