<?php
namespace App\Http\Controllers;

use App\Http\BaseResponse;
use App\Models\SideDish;
use App\Models\HotSaless;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class SideDishController extends Controller
{
    private $ImagePath = 'data/side-dish';
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
            $data = SideDish::orderBy('id', 'asc')->get();
            $data = $data->map(function ($item) {
                if (!empty($item->Image)) {
                    $item->Image = url('/public/data/side-dish/' . $item->Image);
                }
                return $item;
            });
            return BaseResponse::withData($data);
        } else {
            $data = SideDish::find($id);
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
                $dish = new SideDish();
                $dish->Name = $request->Name;
                $dish->Price = $request->Price;
                $dish->Unit = $request->Unit;

                $dish->save();

                if ($request->hasFile('Image')) {
                    $file = $request->file('Image');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $ImageName = $fileName . '_' . time() . '.' . $request->Image->extension();
                    $request->Image->move(public_path($this->ImagePath), $ImageName);
                    $dish->Image = $ImageName;
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
            $dish = SideDish::find($id);
            if ($dish) {
                try {
                    if ($dish -> has('Name')) {
                        $dish->Name = $request->Name;
                    }
                    if ($dish -> has('Price')) {
                        $dish->Price = $request->Price;
                    }
                    if ($dish -> has('Unit')) {
                        $dish->Unit = $request->Unit;
                    }
                    $dish->save();
                    if ($request->hasFile('Image')) {
                        // get old Image
                        $oldImage = $dish->Image;
                        if (!empty($oldImage)) {
                            if (File::exists(public_path($this->ImagePath . '/' . $oldImage))) {
                                File::delete(public_path($this->ImagePath . '/' . $oldImage));
                            }
                        }
                        $file = $request->file('Image');
                        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $ImageName = $fileName . '_' . time() . '.' . $request->Image->extension();
                        $request->Image->move(public_path($this->ImagePath), $ImageName);
                        $dish->Image = $ImageName;
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
        $data = SideDish::find($id);
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