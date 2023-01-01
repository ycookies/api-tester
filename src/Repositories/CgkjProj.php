<?php

namespace Dcat\Admin\ApiTester\Repositories;

use Dcat\Admin\ApiTester\Models\CgkjProj as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CgkjProj extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
