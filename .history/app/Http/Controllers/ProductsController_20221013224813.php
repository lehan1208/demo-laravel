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
        'Code' => 'required',
        'Name' => 'required',
        'Price' => 'required|numeric|min:0',
        'Unit' => 'required',
        'Amount' => 'numeric',
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

// api site admin


    // get all product types admin sites
    public function index($id = null)
    {
        if ($id == null) {
            $data = Product::with('productType')->orderBy('PRO_ID', 'asc')->get();
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

    // thêm product admin site
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            try {
                $product = new Product();
                $product->Code = $request->Code;
                $product->Name = $request->Name;
                $product->Votes = $request->Votes;
                $product->Price = $request->Price;
                $product->Unit = $request->Unit;
                $product->Materials = $request->Materials;
                $product->Amount = $request->Amount;
                // $product->Description = $request->description;
                if ($request->Description) { // kiểm tra nếu có email mà không thay đổi thì giữ nguyên email cũ
                    $product->Description = $request->Description;
                }
                if ($request->Image) { // kiểm tra nếu có email mà không thay đổi thì giữ nguyên email cũ
                    $product->Image = $request->Image;
                }

                // san pham duoc hien thi
                // $product->is_show = 1; 
                $product->TYPE_ID = $request->TYPE_ID;
                $product->save();

                if ($request->hasFile('Image')) {
                    $file = $request->file('Image');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $fileName . '_' . time() . '.' . $request->Image->extension();
                    $request->Image->move(public_path($this->imagePath), $imageName);

                    $product->Image = $imageName;
                    $product->save();
                }
                return BaseResponse::withData($product);
            } catch (\Throwable $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }
    }

    // update product admin site
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            $product = Product::find($id);
            if ($product) {
                try {
                    $product->Code = $request->Code;
                    $product->Name = $request->Name;
                    $product->Votes = $request->Votes;
                    if ($request->Price != null) {
                        $product->Price = $request->Price;
                    }
                    $product->Unit = $request->Unit;
                    $product->Materials = $request->Materials;
                    $product->is_show = 1; 
                    $product->TYPE_ID = $request->TYPE_ID;
                    $product->Amount = $request->Amount;
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

    // delete product admin site 
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
        // Pagination
        $page = is_null($request->page) ? 1 : $request->page;
        $size = is_null($request->size) ? 10 : $request->size;

    
        // Sort
        $sortBy = is_null($request->sortBy) ? 'PRO_ID' : $request->sortBy;
        $sortDir = is_null($request->sortDir) ? 'DESC' : $request->sortDir;

        // Filter: Ko gửi lên thì thôi, ko cần giá trị mặc định.
        $filterBy = $request->filterBy;
        $priceFrom = $request->priceFrom;
        $priceTo = $request->priceTo;


        // Các câu này gọi là Eloquent của Laravel. (where=lọc)
        $data = Product::with('productType')
        ->where('is_show', 1);

        if (!is_null($filterBy) && !is_null($priceFrom)) {
            $data = $data->where($filterBy, '>=', $priceFrom);
        }
        if (!is_null($filterBy) && !is_null($priceTo)) {
            $data = $data->where($filterBy, '<', $priceTo);
        }

        // Search
        $name = $request->name;
        if (!is_null($name)) {
            $data = $data->where('name', 'like', '%' . $name . '%'); // LIKE để hỗ trợ search Tương đối
        }



        // $data = $data->orderBy($sortBy, $sortDir)
        // ->paginate($size)
        // //->toArray()
        // ; // Đoạn này sẽ trả về collection trong Laravel

        // // print_r($data['current_page']);
        // // //print_r(collect($data['items']));
        // //     die;

        // print_r(123);
        // print_r($data['data']);
        // die;

        // // Đoạn xử lý ảnh products
        // foreach (collect($data['data']) as $item) {
        //     // print_r($item);
        //     // die;
        //     if (!empty($item->Image)) {
        //         $item->Image = url('public/data/products/' . $item->Image);
        //     }
        // }
        // return BaseResponse::withData($this->paginate($data));

        $data = $data->orderBy($sortBy, $sortDir)
        ->paginate($size)
        ->toArray(); // Đoạn này sẽ trả về collection trong Laravel

        // print_r($data['current_page']);
        // //print_r(collect($data['items']));
        //     die;

        // Đoạn xử lý ảnh products
        //foreach (collect($data['items']) as $item) {

        $items = [];
        foreach ($data['data'] as $item) {
            // print_r($item);
            // die;
            if (!empty($item->Image)) {
                $item->Image = url('public/data/products/' . $item->Image);
            }
        }
        return BaseResponse::withData($data);
    }

    //Viết hàm cho gọn response pagination

    public function paginate($pagination)
    {
        $pagination = $pagination->toArray();
        return [
            'items' => $pagination['data'], // 3 items.
            'total' => $pagination['total'],
            'current_page' => $pagination['current_page'],
            'last_page' => $pagination['last_page']
        ];
    }
}

