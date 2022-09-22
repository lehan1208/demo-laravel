<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function getList($id = null)
    {
        if ($id == null) {
            return Employee::all();
        } else {
            $row = Employee::find($id);
            if ($row) {
                return ($row);
            } else {
                return response()->json(['message' => 'Data not found!'], 404);
            };
        }
    }
    public function create(Request $request)
    {
        // todo Validation
        try {
            $employee = new Employee();
            $employee->LastName = $request->LastName;
            $employee->FirstName = $request->FirstName;
            $employee->Email = $request->Email;
            $employee->Phone = $request->Phone;
            $employee->save();
            return $employee;
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update($id, Request $request)
    {
        // todo Validation
        $employee = Employee::find($id);
        if ($employee) {
            try {
                $employee->LastName = $request->LastName;
                $employee->FirstName = $request->FirstName;
                if ($request->Email) {// kiểm tra nếu có email mà không thay đổi thì giữ nguyên email cũ
                    $employee->Email = $request->Email;
                }
                if ($request->Phone) {// kiểm tra nếu có SDT mà không thay đổi thì giữ nguyên SDT cũ
                    $employee->Phone = $request->Phone;
                }
                $employee->save();
                return $employee;
            } catch (\Throwable $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Data not found!'], 404);
        }
    }
}
