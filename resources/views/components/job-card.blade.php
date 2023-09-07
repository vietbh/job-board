<x-card class="mb-4">
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">
            {{$job->title}}
        </h2>
        <div class="text-slate-500">
            ${{number_format($job->salary)}}
        </div>
    </div>

    <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
        <div class="flex items-center space-x-3">
            <div >Công ty <span class="font-bold">{{$job->employer->company_name}}</span></div>
            <div>Địa chỉ <span class="font-bold">{{$job->location}}</span> </div>
            @if ($job->deleted_at)
                <span class="text-xs text-red-500">Đã xóa</span>
            @endif
        </div>
        <div class="flex space-x-1 text-xs">
            <x-tag>
                <a href="{{ route('job.index', ['experience' => $job->experience]) }}">
                    {{ Str::ucfirst($job->experience) }}
                </a>
            </x-tag>
            
            <x-tag>
                <a href="{{ route('job.index', ['category' => $job->category]) }}">
                    {{$job->category}}
                </a>
            </x-tag>
        </div>
    </div>

    
    
    {{$slot}}
</x-card>    