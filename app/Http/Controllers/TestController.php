<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index()
    {
        $test = Test::all();

        $data = [
          'status' => 200,
          'test' => $test,
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'type' => 'required',
            'email' => 'required|email',
            'phone' => 'required|phone',
        ]);

        if($validator->fail())
        {
            $data = [
                "status" => 422,
                "message" => $validator->message()
            ];

            return response()->json($data, 422);
        }

        else {
            $test = new Test;

            $test->name = $request->name;
            $test->type = $request->type;
            $test->email = $request->email;
            $test->phone = $request->phone;

            $test->save();

            $data = [
                'status' => 200,
                'message' => 'Data uploaded Successfully'
            ];

            return response()->json($data, 200);
        }
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'type' => 'required',
            'email' => 'required|email',
            'phone' => 'required|phone',
        ]);

        if($validator->fail())
        {
            $data = [
                "status" => 422,
                "message" => $validator->message()
            ];

            return response()->json($data, 422);
        }

        else {
            $test = Test::find($id);

            $test->name = $request->name;
            $test->type = $request->type;
            $test->email = $request->email;
            $test->phone = $request->phone;

            $test->save();

            $data = [
                'status' => 200,
                'message' => 'Data Updated Successfully'
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($id)
    {
        $test = Test::find($id);

        $test->delete();

        $data = [
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ];

        return response()->json($data, 200);
    }
}
