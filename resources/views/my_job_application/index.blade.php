<x-layout>
    <x-breadcrumbs class="mb-4"
    :links="['Công việc đã ứng tuyển' => '#']"
    />
    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>
                        Ứng tuyển vào {{$application->created_at->diffForHumans()}}
                    </div>
                    <div>
                        Số người ứng tuyển 
                        {{-- {{ Str::plural('applicant',$application->job->job_applications_count - 1)}} --}}
                        {{ number_format($application->job->job_applications_count - 1) }}
                    </div>
                    <div>
                        Mức lương bạn mong muốn ${{ number_format($application->expected_salary) }}
                    </div>
                    <div>
                        Lương trung bình mong muốn ${{number_format($application->job->job_applications_avg_expected_salary) }}
                    </div>
                </div>
                <div>
                   <form action="{{ route('my-job-applications.destroy', $application) }}" method="post">
                    @csrf
                    @method('delete')
                    <x-button class="text-red-600">Hủy</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="p-8 rounded-md border border-dashed border-slate-400">
            <div class="text-center font-medium">
                Bạn không ứng tuyển công việc nào!
            </div>
            <div class="text-center">
                Một số công việc gợi ý
                <a class="text-indigo-500 hover:underline" href="{{ route('job.index') }}">tại đây</a>
            </div>
        </div>
    @endforelse
</x-layout>