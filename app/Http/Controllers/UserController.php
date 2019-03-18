<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiControllerTrait;

class UserController extends Controller
{
    protected $model;
    use ApiControllerTrait;

    public function __construct(User $model) {
        $this->model = $model;
    }
}
