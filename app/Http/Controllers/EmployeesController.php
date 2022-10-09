<?php

namespace App\Http\Controllers;


use App\Http\BaseResponse;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;

class EmployeesController extends Controller
{
    private $imagePath = 'data/employees';
    private $rules = [
        'lastName' => 'required|min:2|max:50',
        'firstName' => 'required|max:50',
        'email' => 'email',
        'phone' => 'max:10'
    ];

    private $messages = [
        'lastName.required' => 'Last Name is required',
        'lastName.min' => 'Last Name must be at least 2 characters',
        'lastName.max' => 'Last Name must be less than 50 characters',
        'firstName.required' => 'First Name is required',
        'email.email' => 'Email is not valid',
        'phone.max' => 'Phone must be 10 characters',
    ];

    
    public function index($id = null)
    {
        if ($id == null) {
            // get list
            $rows = Employee::orderBy('EMP_ID', 'asc')->get();
            $rows = $rows->map(function ($row) {
                if (!empty($row->Image)) {
                    $row->Image = url('public/data/employees/' . $row->Image);
                }
                return $row;
            });
            return BaseResponse::withData($rows);
        } else {
            // get one row
            // $data =  Employee::find($id);
            $data = Employee::where('EMP_ID', $id)->first();
            if ($data) {
                if(!empty($data->Image)) {
                    $data->Image = url('/public/data/employees/'. $data->Image);
                }
                return BaseResponse::withData($data);
            } else {
                return BaseResponse::error(404, 'Data not found!');
            }
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return BaseResponse::error(400, $validator->messages()->toJson());
        } else {
            try {
                $employee = new Employee();
                $employee->LastName = $request->lastName;
                $employee->FirstName = $request->firstName;
                $employee->Email = $request->email;
                $employee->Phone = $request->phone;
                $employee->save();

                if ($request -> hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $fileName . '_' . time() . '.' . $request->avatar->extension();
                    $request->avatar->move(public_path($this->imagePath), $imageName);

                    $employee->Image = $imageName;
                    $employee->save();
                }

                return BaseResponse::withData($employee);
            } catch (Throwable $e) {
                return BaseResponse::error(500, $e->getMessage());
            }
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return BaseResponse::error(1, $validator->messages()->toJson());
        } else {
            $employee = Employee::find($id);
            if ($employee) {
                try {
                    $employee->LastName = $request->lastName;
                    $employee->FirstName = $request->firstName;
                    if ($request->Email) { // kiểm tra nếu có email mà không thay đổi thì giữ nguyên email cũ
                        $employee->Email = $request->email;
                    }
                    if ($request->Phone) { // kiểm tra nếu có SDT mà không thay đổi thì giữ nguyên SDT cũ
                        $employee->Phone = $request->phone;
                    }
                    $employee->save();

                    if ($request->hasFile('avatar')) {
                        // get old image
                        $oldImage = $employee->Image;
                        if (!empty($oldImage)) {
                            if (File::exists(public_path($this->imagePath . '/' . $oldImage))) {
                                File::delete(public_path($this->imagePath . '/' . $oldImage));
                            }
                        }
                        $file = $request->file('avatar');
                        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $imageName = $fileName . '_' . time() . '.' . $request->avatar->extension();
                        $request->avatar->move(public_path($this->imagePath), $imageName);

                        $employee->Image = $imageName;
                        $employee->save();
                    }
                    return BaseResponse::withData($employee);
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
        $employee = Employee::find($id);
        if ($id) {
            try {
                $employee->delete();
                return BaseResponse::withData($employee);
            } catch (Throwable $e) {
                return BaseResponse::error(500, $e->getMessage());
            }
        } else {
            return BaseResponse::error(404, 'Data not found!');
        }
    }

    public function getPaging(Request $request)
    {
        $page = intval($request->query('p', '0'));
        $rowPerPage = intval($request->query('r', '20'));

        $data = Employee::orderBy('FirstName', 'asc')->get();
        $pagingData = $data->forPage($page + 1, $rowPerPage)->values();

        $pagingInfo = [
            'page' => $page,
            'totalRow' => $data->count(),
            'rowPerPage' => $rowPerPage,
            'totalPage' => ceil($data->count() / $rowPerPage),
        ];

        return BaseResponse::withData($pagingData, $pagingInfo);
    }
}
