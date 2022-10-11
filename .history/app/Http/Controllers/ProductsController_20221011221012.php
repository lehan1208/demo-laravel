<?php

namespace App\Http\Controllers;

use App\Http\BaseResponse;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    private $imagePath = 'data/products';
    private $rules = [
        'code' => 'required',
        'name' => 'required',
        'price' => 'required|numeric|min:0',
        'unit' => 'required',
        'amount' => 'numeric',
        'TYPE_ID' => 'required|numeric',

    ];

    private $messages = [
        'code.required' => 'Product code is required',
        'name.required' => 'Product name is required',
        'price.numeric' => 'Price must be 09onumberic value',
        'price.min' => 'Price must be greater than 0',
        'TYPE_ID.numeric' => 'TYPE_ID must be numberic value',
        'TYPE_ID.min' => 'TYPE_ID must be greater than 0',
        'amount.required' => 'Quantity is required',
    ];

    public function index($id = null)
    {
        if ($id == null) {
            $data = Product::with('productType')->orderBy('TYPE_ID', 'asc')->get();
            $data = $data->map(function ($row) {
                if (!empty($row->Image)) {
                    $row->Image = url('public/data/products/' . $row->Image);
                }
                return $row;
            });
            return BaseResponse::withData($data);
        } else {
            $data = Product::find($id);
            if ($data) {
                if (!empty($data->Image)) {
                    $data->Image = url('public/data/products/' . $data->Image);
                }
                return BaseResponse::withData($data);
            } else {
                return BaseResponse::error(404, 'Data not found!');
            };
        }
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            try {
                $product = new Product();
                $product->Code = $request->code;
                $product->Name = $request->name;
                $product->Votes = $request->votes;
                $product->Price = $request->price;
                $product->Unit = $request->unit;
                $product->Materials = $request->materials;
                $product->Amount = $request->amount;
                $product->Description = $request->description;
                // $product->Image = $request->image;

                // san pham duoc hien thi
                $product->is_show = 1; 
                $product->TYPE_ID = $request->TYPE_ID;
                $product->save();

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $fileName . '_' . time() . '.' . $request->image->extension();
                    $request->image->move(public_path($this->imagePath), $imageName);

                    $product->Image = $imageName;
                    $product->save();
                }
                return BaseResponse::withData($product);
            } catch (\Throwable $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            $product = Product::find($id);
            if ($product) {
                try {
                    $product->Code = $request->code;
                    $product->Name = $request->name;
                    $product->Votes = $request->votes;
                    if ($request->Price != null) {
                        $product->Price = $request->price;
                    }
                    $product->Unit = $request->unit;
                    $product->Materials = $request->materials;
                    $product->Amount = $request->amount;
                    if ($request -> has('Description')) {
                        $product->Description = $request->description;
                    }
                    // $product->Image = $request->image;
                    $product->save();

                    if ($request->hasFile('image')) {
                        // get old image
                        $oldImage = $product->Image;
                        if (!empty($oldImage)) {
                            if (File::exists(public_path($this->imagePath . '/' . $oldImage))) {
                                File::delete(public_path($this->imagePath . '/' . $oldImage));
                            }
                        }
                        $file = $request->file('image');
                        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $imageName = $fileName . '_' . time() . '.' . $request->image->extension();
                        $request->image->move(public_path($this->imagePath), $imageName);

                        $product->Image = $imageName;
                        $product->save();
                    }
                    return BaseResponse::withData($product);
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
        $data = Product::find($id);
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


    // api customer site 


    public function publicGetProductsAll(Request $request)
    {
        // Nhận từ FE
        $page = $request->page;
        $size = $request->size;

    
        $data = Product::with('productType')
        ->where('is_show', 1)
        ->orderBy('TYPE_ID', 'asc')
        ->paginate($size)
        ->toArray();

        // Đoạn xử lý ảnh product.
        // $data = $data->map(function ($row) {
        //     if (!empty($row->Image)) {
        //         $row->Image = url('public/data/products/' . $row->Image);
        //     }
        //     return $row;
        // });
        return BaseResponse::withData($data);
    }
}

