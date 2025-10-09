<?php

namespace App\Services;

use App\Http\Requests\StoreComputerRequest;

class ComputerService
{

    public function store(StoreComputerRequest $request){
        $request->header('r');
    }
}
