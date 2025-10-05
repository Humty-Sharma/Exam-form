<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamForm;

class ExamController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function redirectAdmin()
    {
        // return redirect()->route('admin.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $forms = ExamForm::where('is_active',1)->paginate(10);
        return view('exam',compact('forms'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function show(ExamForm $examForm){ 
        $examForm->load('fields'); 
        return view('exam_details', compact('examForm')); 
    }
}
