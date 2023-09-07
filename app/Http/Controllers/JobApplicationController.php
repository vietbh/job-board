<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{

    public function index()
    {
        return view('my_job_application.index',
        [
            'applications' => auth()->user()->jobApplications()
                ->with([
                    'job' =>fn($query)=>$query->withCount('jobApplications')
                        ->withAvg('jobApplications', 'expected_salary')
                        ->withTrashed(),
                    'job.employer'
                ])
                ->latest()->get()
        ]    
        );
    }
    public function create(Job $job)
    {
        $this->authorize('apply',$job);
        return view('job_application.create',compact('job'));
    }

    public function store(Job $job, Request $request)
    {
        $this->authorize('apply',$job);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');

        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);
        return redirect()->route('job.show', $job)
            ->with('success', 'Đơn ứng tuyển gửi thành công');
    }

     public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();
        return redirect()->back()->with(
            'success',
            'Đã hủy yêu cầu ứng tuyển.'
        );
    }
}
