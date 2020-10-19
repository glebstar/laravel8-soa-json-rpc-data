<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Data;

class DataController extends Controller
{
    public function getPageById(array $params)
    {
        return Data::where('page_uid', $params['page_uid'])->first();
    }

    public function create(array $params)
    {
        $validator = Validator::make($params, [
            'page_uid' => 'required|unique:data|max:255',
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return Data::create($params);
    }

    public function getPages(array $params)
    {
        return Data::get();
    }
}
