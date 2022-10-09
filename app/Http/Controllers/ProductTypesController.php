<?php

namespace App\Http\Controllers;

use App\Http\BaseResponse;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductTypesController extends Controller
{
    private $rules = [
        'name' => 'required',
    ];

    private $messages = [
        'name.required' => 'Name is required',

    ];


    public function index($id = null) 
    {
        if ($id == null) {
            $data = ProductType::orderBy('TYPE_ID', 'asc')->get();
            return BaseResponse::withData($data);
        } else {
            $data = ProductType::find($id);
            if ($data) {
                return BaseResponse::withData($data);
            } else {
                return BaseResponse::error(404, 'Data not found!');
            };
        }
    }

    // add
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            try {
                $productType = new ProductType();
                $productType->Name = $request->name;
                $productType->save();
                return BaseResponse::withData($productType);
            } catch (\Throwable $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }
    }

    // update
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            $productType = ProductType::find($id);
            if ($productType) {
                try {
                    $productType->Name = $request->name;
                    $productType->save();
                    return BaseResponse::withData($productType);
                } catch (\Throwable $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
                }
            } else {
                return BaseResponse::error(404, 'Data not found!');
            }
        }
    }
    public function delete($id)
    {
        $data = ProductType::find($id);
        if ($data) {
            try {
                $data->delete();
                return BaseResponse::withData($data);
            } catch (\Throwable $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        } else {
            return BaseResponse::error(404, 'Data not found!');
        }
    }
}
