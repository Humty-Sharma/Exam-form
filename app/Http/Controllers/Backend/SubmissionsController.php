<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionsController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the submissions
     */
    public function index()
    {
        // Latest submissions first
        $submissions = Submission::with(['examForm', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.pages.submissions.index', compact('submissions'));
    }

    /**
     * Show the details of a single submission
     */
    public function show(Submission $submission)
    {
        // eager load relations
        $submission->load(['examForm', 'user', 'payments']);

        return view('backend.pages.submissions.show', compact('submission'));
    }
}
