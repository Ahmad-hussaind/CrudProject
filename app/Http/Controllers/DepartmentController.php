<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request) {

    $departments = Department::latest()->paginate(5);
    return view('list',[
        'departments' => $departments
    ]);

}

    public function create() {
        return view('department');

}

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            
        ]);
         
        if ($validator->passes()) {

            $department = new Department();

            $department->name = $request->name;
            $department->save();

            return response()->json([
                    'status' => true,
                    'message' => 'Department Create Successfully.',
  
            ]);

                    } else {
                        return response()->json([
                            'status' => false,
                            'errors' => $validator->errors()
                        ]);
                        
                    }

        }

        

    public function edit($id, Request $request) {

        $department = Department::find($id);

        if (empty($department)) {
            return redirect()->route('department.index');
        }

        return view('edit',[
            'department' => $department
        ]);

    }

    public function update($id,Request $request) {

        $department = Department::find($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            
        ]);
         
        if ($validator->passes()) {

             

            $department->name = $request->name;
            $department->save();


            return response()->json([
                'status' => true,
                'message' => 'Department Update successfully'
            ]);


    } else {
        return response()->json([
            'status' => true,
            'errors' => $validator->errors()
        ]);

    }

}


    public function destroy($id,Request $request) {
        $department = Department::find($id);

        if (empty($department)) {
            
            $request->session()->flash('error','Category not found.');

            return response()->json([
                'status' => true,
                'message' => 'Department not found .',
            ]);
        }

        $department->delete();
        
        $request->session()->flash('success','Department deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Department deleted successfully .'
        ]);

    }



}
