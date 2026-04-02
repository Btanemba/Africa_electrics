<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('deadline')->orWhere('deadline', '>=', now());
            })
            ->latest()
            ->get();

        return view('company.jobs', compact('jobs'));
    }

    public function show(JobListing $job)
    {
        if (!$job->is_active) {
            abort(404);
        }

        return view('company.job-detail', compact('job'));
    }

    public function apply(Request $request, JobListing $job)
    {
        if (!$job->is_active) {
            abort(404);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'cover_letter' => 'nullable|string|max:5000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $application = new JobApplication();
        $application->job_listing_id = $job->id;
        $application->full_name = $validated['full_name'];
        $application->email = $validated['email'];
        $application->phone = $validated['phone'] ?? null;
        $application->cover_letter = $validated['cover_letter'] ?? null;

        if ($request->hasFile('resume')) {
            $application->resume_path = $request->file('resume')->store('job-applications/resumes', 'public');
        }

        if ($request->hasFile('cover_letter_file')) {
            $application->cover_letter_path = $request->file('cover_letter_file')->store('job-applications/cover-letters', 'public');
        }

        $application->save();

        return redirect()->route('jobs.show', $job)->with('success', 'Your application has been submitted successfully!');
    }
}
