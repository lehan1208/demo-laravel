<?php

namespace App\Http\Controllers;

use App\Http\BaseResponse;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductTypesController extends Controller
{
    private $imagePath = 'data/product-types';
    private $rules = [
        'Name' => 'required',
    ];

    private $messages = [
        'Name.required' => 'Name is required',

    ];


    // api cho admin

    public function index($id = null)
    {
        if ($id == null) {
            $data = ProductType::orderBy('TYPE_ID', 'asc')->get();
            return BaseResponse::withData($data);
        } else {
            $data = ProductType::find($id);
            $data->icon = url('public/data/product-types/' . $data->icon);
            if ($data) {
                return BaseResponse::withData($data);
            } else {
                return BaseResponse::error(404, 'Data not found!');
            };
        }
    }

    // add product
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            try {
                $productType = new ProductType();
                $productType->Name = $request->Name;
                $productType->is_show = is_null($request->is_show) ? 1 : $request->is_show;
                $productType->save();

                if ($request->hasFile('icon')) {
                    $file = $request->file('icon');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $fileName . '_' . time() . '.' . $request->icon->extension();
                    $request->icon->move(public_path($this->imagePath), $imageName);

                    $productType->icon = $imageName;
                    $productType->save();
                }
                return BaseResponse::withData($productType);
            } catch (\Throwable $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }
    }

    // update product
    public function update($id, Request $request)
    {
        print_r($request->all());
        die;
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            $productType = ProductType::find($id);
            if ($productType) {
                try {
                    $productType->Name = $request->Name;
                    $productType->is_show = 1;

                    $productType->save();

                    if ($request->hasFile('icon')) {
                        // get old image
                        $oldImage = $productType->icon;
                        if (!empty($oldImage)) {
                            if (File::exists(public_path($this->imagePath . '/' . $oldImage))) {
                                File::delete(public_path($this->imagePath . '/' . $oldImage));
                            }
                        }
                        $file = $request->file('icon');
                        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $imageName = $fileName . '_' . time() . '.' . $request->icon->extension();
                        $request->icon->move(public_path($this->imagePath), $imageName);

                        $productType->icon = $imageName;
                        $productType->save();
                    }
                    return BaseResponse::withData($productType);
                } catch (\Throwable $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
                }
            } else {
                return BaseResponse::error(404, 'Data not found!');
            }
        }
    }

    // delete product
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

    // api cho customer - client

    public function publicGetAll()
    {

        $data = ProductType::where('is_show', 1)->orderBy('TYPE_ID', 'asc')->get();
        $newData = [];
        foreach ($data as $item) {
            if (!empty($item['icon'])) {
                $item['icon'] = url('public/data/product-types/' . $item['icon']);
                array_push($newData, $item);
            }
        return BaseResponse::withData($data);
    }
    }
}
