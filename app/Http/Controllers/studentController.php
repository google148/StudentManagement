<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courseModel;
use App\Models\studentModel;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* This is a function that is called when the user goes to the student page. It is getting all
        the students and courses from the database and then displaying them on the page. */
        $course = courseModel::all();
        $students = studentModel::all();
        return view('showAllStudent')->with('students',$students)->with('course',$course);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* This is the function that is called when the user clicks the submit button on the add
        student page. It is getting the data from the form and then saving it to the database. */
        
        /* This is checking if the user has uploaded an image. If they have then it is validating the
        image and then saving it to the database. If they have not uploaded an image then it is
        setting the image name to noimage.png. */
        $imageName = 'noimage.png';
        if($request->img){
            $request->validate([
                'img' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = date('mdYHis').uniqid().'.'.$request->img->extension();
            $request->img->move(public_path('uploaded_img'),$imageName);
        }

        $student = new studentModel();
        $student->name = $request->name;
        $student->img = $imageName;
        $student->phone = $request->phone;
        $student->course_id = $request->course_id;
        $student->save();
        return redirect('student');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * It takes the id of the student, finds the student in the database, checks if the user has
     * uploaded a new image, if yes, it deletes the old image, uploads the new image, and updates the
     * database with the new image name. If no, it just updates the database with the old image name
     * 
     * @param Request request The request object represents the HTTP request and has properties for the
     * request query string, parameters, body, HTTP headers, and so on.
     * @param id The id of the student you want to update.
     */
    public function update(Request $request, $id)
    {
        
        $student =  studentModel::find($id);

        /* This is checking if the user has uploaded an image. If they have then it is validating the
                image and then saving it to the database. If they have not uploaded an image then it
        is
                setting the image name to noimage.png. */
        if($request->img){
            $request->validate([
                'img' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            
            if($student->img !='noimage.png'){
                unlink(public_path('uploaded_img').'/'.$student->img);
            }

            $imageName = date('mdYHis').uniqid().'.'.$request->img->extension();
            $request->img->move(public_path('uploaded_img'),$imageName);
       
       
        }else{
            $imageName = $student->img;

        }



        $student->name = $request->name;
        $student->img = $imageName;
        $student->phone = $request->phone;
        $student->course_id = $request->course_id;

        $student->save();
        return redirect('student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        /* Deleting the student from the database and then deleting the image from the server. */
        $student=studentModel::find($id);
        if($student->img !='noimage.png'){
            unlink(public_path('uploaded_img').'/'.$student->img);
        }
        $student->delete();
        return redirect('student');
    }
}
