<?php

namespace App\Http\Controllers;

use App\Course;
use App\ImageCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageCourseController extends Controller
{
    public function create(Request $request){
        $rules = [
            'image' => 'required|string',
            'course_id' => 'required|integer'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $courseId = $request->input('course_id');
        $course = Course::find($courseId);

        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'COURSE NOT FOUND'
            ], 404); 
        }

        $imagecourse = ImageCourse::create($data);

        return response()->json([
            'status' => 'SUKSES',
            'data' => $imagecourse
        ]);
    }

    public function destroy($id){
        $imagecourse = ImageCourse::find($id);

        if (!$imagecourse){
            return response()->json([
                'status' => 'error',
                'message' => 'IMAGE COURSE NOT FOUND'
            ], 404);
        };

        $imagecourse->delete();
        return response()->json([
            'status' => 'SUKSES',
            'message' => 'IMAGE COURSE DELETED'
        ]);
    }
}
