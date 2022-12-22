<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\project;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function displayAddStudent()
    // {
    //     $teacher = user::all();
    //     $student = student::all();
    //     return view("adminPage",['data'=>$value]);
    // }

    public function displayAddProject()
    {
        $teacher = user::all();
        $student = student::all();
        return view("addproject", ['teacher' => $teacher, 'student' => $student]);
    }

    public function displayProjects()
    {
        $teacher = user::all();
        $student = student::all();
        $project = project::paginate(5);
        if (Auth::user()->usertype == "Superviser") {
            return view("displayProjectssv", ['teacher' => $teacher, 'student' => $student, 'project' => $project]);
        } else {
            return view("displayProjects", ['teacher' => $teacher, 'student' => $student, 'project' => $project]);
        }
    }

    public function displayAddStudent()
    {
        return view("addstudent");
    }

    public function displaystudents()
    {
        $student = student::paginate(5);
        $project = project::all();
        $teacher = user::all();

        return view("displayStudents", ['student' => $student, 'project' => $project, 'teacher' => $teacher]);
    }

    public function showupdate($id)
    {
        $teacher = user::all();
        $student = student::all();
        $project = project::all();
        $selected = project::find($id);
        if (Auth::user()->usertype == "Superviser") {
            return view("updateProjectsv", ['teacher' => $teacher, 'student' => $student, 'project' => $project, 'selected' => $selected]);
        } else {
            return view("updateProjectsadmin", ['teacher' => $teacher, 'student' => $student, 'project' => $project, 'selected' => $selected]);
        }
    }

    public function updateprojects(Request $req)
    {
        $project = project::find($req->projectid);



        if (Auth::user()->usertype == "Superviser") {
            $project->startdate = $req->startdate;
            $project->enddate = $req->enddate;
            $project->progress = $req->progress;
            $project->status = $req->status;
            $project->duration = $req->duration;
            $project->save();
        } else {
            $project->studentid = $req->studentid;
            $project->projecttitle = $req->projecttitle;
            $project->category = $req->category;
            $project->superviserid = $req->superviserid;
            $project->examinerid1 = $req->examinerid1;
            $project->examinerid2 = $req->examinerid2;
            $project->save();
            if ($project->save()) {
                $student = student::find($req->studentid);

                $student->projectid = $project->projectid;
                $student->superviserid = $project->superviserid;
                $student->save();
            }
        }


        return redirect('/displayprojects');
    }



    public function addnewstudent(Request $req)
    {
        $student = new student;

        try {

            $student->studentid = $req->studentid;
            $student->username = $req->username;
            $student->projectid = NULL;
            $student->save();
            return redirect('/displaystudents'); 
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                dd('Duplicate Entry');
                return redirect('/add');
            }
        }

        
    }

    public function addnewproject(Request $req)
    {
        $project = new project;

        $project->studentid = $req->studentid;
        $project->projecttitle = $req->projecttitle;
        $project->category = $req->category;
        $project->superviserid = $req->superviserid;
        $project->examinerid1 = $req->examinerid1;
        $project->examinerid2 = $req->examinerid2;
        $project->startdate = NULL;
        $project->enddate = NULL;
        $project->progress = NULL;
        $project->status = NULL;
        $project->duration = NULL;

        $project->save();
        if ($project->save()) {
            $student = student::find($req->studentid);

            $student->projectid = $project->projectid;
            $student->superviserid = $project->superviserid;
            $student->save();
        }

        return redirect('/displayprojects');
    }

    function deleteprojects($id)
    {
        DB::update('update students set superviserid = NULL,projectid = NULL where projectid=?', [$id]);
        DB::delete('delete from projects where projectid=?', [$id]);
        return redirect('/displayprojects');
    }

    function deletestudents($id)
    {
        DB::delete('delete from students where studentid=?', [$id]);
        DB::delete('delete from projects where studentid=?', [$id]);
        return redirect('/displaystudents');
    }

    // public function add()
    // {
    //     return view("addStudent");
    // }
    public function index()
    {
        return view('home');
    }
}
