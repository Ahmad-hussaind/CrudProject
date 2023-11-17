<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Image;

class EmployeeController extends Controller
{

    public function index(Request $request){
        // $employees = Employee::select('employees.*','departments.name as departmentName')
        // ->latest()
        // ->leftJoin('departments','departments.id','employees.department_id')
        // ->paginate(5);
   
        // return view('Employee.list',[
        //     'employees' => $employees
        // ]);

        $departments = Department::latest()->with('employees')->paginate(5);

        return view('Employee.list',[
            'departments' => $departments
        ]);

    }



    public function create() {
        $departments = Department::orderBY('name','ASC')->get();
        return view('Employee.create',[
            'departments' => $departments
        ]);
    }


    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'fname' => 'required',
            'lname' => 'required',
            'department_id' => 'required',
            'salary' => 'required',

        ]);

        if ($validator->passes()) {

            $employees = new Employee();

            $employees->fname = $request->fname;
            $employees->lname = $request->lname;
            $employees->department_id = $request->department_id;
            $employees->salary = $request->salary;
            $employees->save();

            


           // save Gallery pick 
           if (!empty($request->image_id)) {
            $tempImage = TempImage::find($request->image_id);
            $extArray = explode('.',$tempImage->name);
            $ext = last($extArray);

            $newImageName = $employees->id.'.'.$ext;
            $sPath = public_path().'/temp/'.$tempImage->name;
            $dPath = public_path().'/uploads/employee/'.$newImageName ;
            File::copy($sPath,$dPath);

            // Genetrate imgae thumble 
                $dPath = public_path().'/uploads/employee/thumb/'.$newImageName;
                $img = Image::make($sPath);
                $img->resize(450,600);
    

                    $img->save($dPath);

                        $employees->profile_pic = $newImageName;
                        $employees->save();
               }

               $request->session()->flash('success','Employee successfully added');
               return response()->json([
                'status' => true,
                'message' => 'Employee successfully Added .'
                ]);

                    } else {
                        return response()->json([
                            'status' => false,
                            'errors' => $validator->errors()
                        ]);
                    }
}



public function edit($id, Request $request) {

    $employee = Employee::find($id);

    if (empty($employee)) {
        return redirect()->route('employees.index');
    }


            $departments = Department::orderBy('name','ASC')->get();

            return view('Employee.edit',[
                'employee' => $employee,
                'departments' => $departments
                
            ]);
            
        }


public function update($id,Request $request) {
    $employees = Employee::find($id);
    $validator = Validator::make($request->all(),[
            'fname' => 'required',
            'lname' => 'required',
            'department_id' => 'required',
            'salary' => 'required',
        
    ]);
     
    if ($validator->passes()) {

                    $employees->fname = $request->fname;
                    $employees->lname = $request->lname;
                    $employees->department_id = $request->department_id;
                    $employees->salary = $request->salary;
                    $employees->save();

                    $oldImage = $employees->image;

                    // save Gallery pick 
                if (!empty($request->image_id)) {
                    $tempImage = TempImage::find($request->image_id);
                    $extArray = explode('.',$tempImage->name);
                    $ext = last($extArray);

                    $newImageName = $employees->id.'.'.$ext;
                    $sPath = public_path().'/temp/'.$tempImage->name;
                    $dPath = public_path().'/uploads/employee/'.$newImageName ;
                    File::copy($sPath,$dPath);

                    // Genetrate imgae thumble 
                        $dPath = public_path().'/uploads/employee/thumb/'.$newImageName;
                        $img = Image::make($sPath);
                        $img->resize(450,600);
            

                            $img->save($dPath);

                                $employees->profile_pic = $newImageName;
                                $employees->save();

                                // OLd images Deleted Here
                            File::delete(public_path().'/uploads/employee/thumb/'.$oldImage);
                            File::delete(public_path().'/uploads/employee/'.$oldImage);
               }

               session()->flash('success','Employee Deleted successfully');

                        return response()->json([
                            'status' => true,
                            'message' => 'Employees Update successfully'
                        ]);


                } else {
                    return response()->json([
                        'status' => true,
                        'errors' => $validator->errors()
                    ]);

                }

                }


public function destroy($id, Request $request) {

                   $employee = Employee::find($id);

                    if (empty($employee)) {
                        $request->session()->flash('error','Employee not found.');

                        return response()->json([
                            'status' => true,
                            'message' => 'Employee not found .',
                        ]);
                    }

                    File::delete(public_path().'/uploads/employee/thumb/'.$employee->profile_pic);
                    File::delete(public_path().'/uploads/employee/'.$employee->profile_pic);

                    $employee->delete();

                    $request->session()->flash('success','Employee deleted successfully.');
            
                    return response()->json([
                        'status' => true,
                        'message' => 'Employee deleted successfully .'
                    ]);

}

}


