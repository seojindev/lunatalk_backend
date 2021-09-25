<?php

namespace App\Repositories\Eloquent;

use App\Models\MainSlides;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\MainSlidesInterface;

class MainSlidesRepository extends BaseRepository implements MainSlidesInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param MainSlides $model
     */
    public function __construct(MainSlides $model)
    {
        parent::__construct($model);
    }
}
