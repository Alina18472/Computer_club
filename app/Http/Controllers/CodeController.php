<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCodeRequest;
use App\Http\Requests\UpdateCodeRequest;
use App\Models\Code;

class CodeController extends Controller
{
    public function index()
    {
        return Code::all();
    }

    public function store(StoreCodeRequest $request)
    {
        return Code::create($request->all());
    }

    public function show(Code $code)
    {
        return $code;
    }

    public function update(UpdateCodeRequest $request, Code $code)
    {
        $code->update($request->all());
        return $code;
    }

    public function destroy(Code $code)
    {
        return $code->delete();
    }
}
