<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Employer::class);
    }
    public function create()
    {
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        auth()->user()->employer()->create(
            $request->validate([
                'company_name' => 'required|min:3|unique:employers,company_name'
            ])
        );

        return redirect()->route('job.index')
            ->with('success', 'Bạn đã tạo thành công!');
    }

   
}
