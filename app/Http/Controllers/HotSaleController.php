<?php

namespace App\Http\Controllers;

use App\Http\BaseResponse;
use App\Models\HotSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class HotSaleController extends Controller
{
    private $imagePath = 'data/hot-sale';
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
            $data = HotSale::orderBy('id', 'asc')->get();
            $data = $data->map(function ($item) {
                if (!empty($item->image)) {
                    $item->image = url('/public/data/hot-sale/' . $item->image);
                }
                return $item;
            });
            return BaseResponse::withData($data);
        } else {
            $data = HotSale::find($id);
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
                $dish = new HotSale();
                $dish->Name = $request->Name;
                $dish->save();

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $fileName . '_' . time() . '.' . $request->image->extension();
                    $request->image->move(public_path($this->imagePath), $imageName);

                    $dish->image = $imageName;
                    $dish->save();
                }
                return BaseResponse::withData($dish);
            } catch (\Throwable $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }
    }

    // update product
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            $dish = HotSale::find($id);
            if ($dish) {
                try {
                    $dish->Name = $request->Name;

                    $dish->save();

                    if ($request->hasFile('image')) {
                        // get old image
                        $oldImage = $dish->image;
                        if (!empty($oldImage)) {
                            if (File::exists(public_path($this->imagePath . '/' . $oldImage))) {
                                File::delete(public_path($this->imagePath . '/' . $oldImage));
                            }
                        }
                        $file = $request->file('image');
                        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $imageName = $fileName . '_' . time() . '.' . $request->image->extension();
                        $request->image->move(public_path($this->imagePath), $imageName);

                        $dish->image = $imageName;
                        $dish->save();
                    }
                    return BaseResponse::withData($dish);
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
        $data = HotSale::find($id);
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
