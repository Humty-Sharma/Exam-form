<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExamForm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamFormController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        $forms = ExamForm::orderBy('created_at','desc')->get();
        return view('backend.pages.exam_forms.index', compact('forms'));
    }

    public function create()
    {
        return view('backend.pages.exam_forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'fees' => 'required|numeric'
        ]);

        ExamForm::create([
            'title' => $request->title,
            'fees' => $request->fees,
            'slug' => $this->generateSlug($request->title),
            'description' => $request->description,
            'is_active' => $request->is_active == 1 ? 1 : 0
        ]);

        return redirect()->route('admin.exam_forms.index')->with('success', 'Exam Form created successfully!');
    }

    public function edit(ExamForm $examForm)
    {
        return view('backend.pages.exam_forms.create', compact('examForm'));
    }

    public function update(Request $request, ExamForm $examForm)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'fees' => 'required|numeric'
        ]);

        $examForm->update([
            'title' => $request->title,
            'fees' => $request->fees,
            'slug' => $this->generateSlug($request->title,$examForm->id),
            'description' => $request->description,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.exam_forms.index')->with('success', 'Exam Form updated!');
    }

    public function destroy(ExamForm $examForm)
    {
        $examForm->delete();
        return redirect()->route('admin.exam_forms.index')->with('success', 'Exam Form deleted!');
    }

    protected function generateSlug($title, $excludeId = null)
    {
        $slug = str_replace(' ', '-', strtolower($title));
        $existing = ExamForm::where('slug', $slug);

        if ($excludeId) {
            $existing = $existing->where('id', '!=', $excludeId);
        }

        $counter = 1;
        while ($existing->exists()) {
            $slug = str_replace(' ', '-', $title) . '-' . $counter;
            $existing = ExamForm::where('slug', $slug);
            if ($excludeId) {
                $existing = $existing->where('id', '!=', $excludeId);
            }
            $counter++;
        }

        return $slug;
    }
}
