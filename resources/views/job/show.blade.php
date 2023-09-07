<x-layout>
   <x-breadcrumbs  class="mb-4" :links="['Cong viec'=> route('job.index'), $job->title =>'#']"></x-breadcrumbs>
    <x-job-card :$job>
        <p class="mb-4 text-sm text-slate-500">{!! nl2br(e($job->description)) !!}</p>

    @can('apply', $job)
        <x-link-button :href=" route('job.application.create', $job) " >
            Ứng tuyển
        </x-link-button>
    @else
        <div class="text-center text-sm font-md text-slate-500">
            Bạn đã Ứng tuyển công việc này!!
        </div>
    @endcan
    </x-job-card>


    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            Xem thêm công việc tại {{$job->employer->company_name}} 
        </h2>
        <div class="text-sm text-slate-500">
            @forelse ($job->employer->jobs as $otherJob)
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('job.show', $otherJob)}}">
                                {{ $otherJob->title}}</a>
                        </div>   
                        <div class="text-xs">
                            {{ $otherJob->created_at->diffForHumans() }}
                        </div> 
                    </div> 
                    <div class="text-xs">
                        ${{number_format($otherJob->salary)}}
                    </div> 
                </div>
            @empty
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-slate-700">
                           Het job
                        </div>   
                        <div class="text-xs">
                            Het job
                        </div> 
                    </div> 
                    <div class="text-xs">
                        $0
                    </div> 
                </div>
            @endforelse
        </div>
    </x-card>
</x-layout>