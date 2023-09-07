<x-layout>
    <x-breadcrumbs :links="['Công việc của tôi' => '#']" class="mb-4" />
    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-job.create') }}">Tạo mới</x-link-button>
    </div>
    @forelse ($jobs as $job)
        <x-job-card :$job>
            <div class="mb-2 text-xs text-slate-500">
                @forelse ($job->jobApplications as $application)
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <div>{{ $application->user->name }}</div>
                            <div>Ứng tuyển vào {{$application->created_at->diffForHumans()}}</div>
                            <div>Tải CV </div>
                        </div>
                        <div>${{number_format($application->expected_salary)}}</div>
                    </div>
                @empty
                    <div class="mb-4">Chưa có ai ứng tuyển</div>
                @endforelse

                <div class="flex space-x-2">
                    <x-link-button href="{{ route('my-job.edit', $job) }}">Edit</x-link-button>
                    <form action="{{ route('my-job.destroy', $job) }}" method="post">
                        @csrf
                        @method('delete')
                        <x-button class="w-full">Xóa</x-button>
                    </form>
                </div>

            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                Bạn chưa đăng công việc nào!
            </div>
            <div class="text-center">
                Đăng việc làm bạn muốn tìm ứng viên 
                <a href="{{ route('my-job.create') }}" class="text-indigo-500 hover:underline">tại đây!</a>
            </div>
        </div>
    @endforelse
</x-layout>