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

    public function getByName(string $name)
    {

        $code = Code::where('name', $name)->first();

        if (!$code) {
            return response()->json(['error' => 'Код не найден'], 404);
        }

        return $code;
    }
}
