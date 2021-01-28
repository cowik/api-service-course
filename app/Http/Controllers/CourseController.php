<?php

namespace App\Http\Controllers;

use App\Course;
use App\MyCourse;
use App\Mentor;
use App\Chapter;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    public function index(Request $request){
        $courses = Course::query();

        $q = $request->query('q');
        $status = $request->query('status');

        $courses->when($q, function($query) use ($q){
            return $query->whereRaw("name LIKE '%".strtolower($q)."%'");
        });

        $courses->when($status, function($query) use ($status){
            return $query->where('status', '=', $status);
        });

        return response()->json([
            'status' => 'SUKSES',
            'data' => $courses->paginate(10)
        ]);
    }

    public function show($id){
        $course = Course::with('chapters.lessons') 
                        ->with('mentor')
                        ->with('images')
                        ->find($id);
        if (!$course){
            return response()->json([
                'status' => 'error',
                'messsage' => 'COURSE NOT FOUND'
            ], 404);
        }

        $review = Review::where('course_id', '=', $id)->get()->toArray();

        if (count($review) > 0){
            $userIds = array_column($review, 'user_id');
            $users = getUserByIds($userIds);
            if ($users['status'] === 'error') {
                $review = [];
            } else {
                foreach($review as $key => $review) {
                    $userIndex = array_search($review['user_id'], array_column($users['data'], 'id'));
                    $review[$key]['users'] = $users['data'][$userIndex];
                }
            }
        }

        $totalStudent = MyCourse::where('course_id', '=', $id)->count();
        $totalVideos = Chapter::where('course_id', '=', $id)->withCount('lessons')->get()->toArray();
        $finalTotalVideos = array_sum(array_column($totalVideos, 'lessons_count'));

        $course['review'] = $review;
        $course['total_videos'] = $finalTotalVideos;
        $course['total_student'] = $totalStudent;

        return response()->json([
            'status' => 'SUKSES',
            'data' => $course
        ]);
    }

    public function create(Request $request){
        $rules = [
            'name' => 'required|string',
            'certificate' => 'required|boolean',
            'thumbnail' => 'string|url',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'integer',
            'level' => 'required|in:all=level,beginner,intermediate,advance',
            'mentor_id' => 'required|integer',
            'description' => 'string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $mentorId = $request->input('mentor_id');
        $mentor = Mentor::find($mentorId);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'MENTOR NOT FOUND'
            ], 404); 
        }

        $course = Course::create($data);

        return response()->json([
            'status' => 'SUKSES',
            'data' => $course
        ]);
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => 'string',
            'certificate' => 'boolean',
            'thumbnail' => 'url',
            'type' => 'in:free,premium',
            'status' => 'in:draft,published',
            'price' => 'integer',
            'level' => 'in:all=level,beginner,intermediate,advance',
            'mentor_id' => 'integer',
            'description' => 'string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'COURSE NOT FOUND'
            ], 404);
        }

        $mentorId = $request->input('mentor_id');

        if ($mentorId) {
            $mentor = Mentor::find($mentorId);
            if (!$mentor) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'MENTOR NOT FOUND'
                ], 404);
            }
        }

        $course->fill($data);

        $course->save();
        return response()->json([
            'status' => 'SUKSES',
            'data' => $course
        ]);
    }

    public function destroy($id){
        $course = Course::find($id);

        if (!$course){
            return response()->json([
                'status' => 'error',
                'message' => 'COURSE NOT FOUND'
            ], 404);
        };

        $course->delete();
        return response()->json([
            'status' => 'SUKSES',
            'message' => 'COURSE DELETED'
        ]);
    }
}
