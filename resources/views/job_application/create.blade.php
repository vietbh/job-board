<x-layout>
    <x-breadcrumbs class="mb-4" 
    :links="[
        'Jobs' => route('job.index'),
        $job->title => route('job.show', $job),
        'Apply' => '#',
        ]" />
    <x-job-card :$job/>
    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            Công việc bạn ứng tuyển
        </h2>

        <form action="{{ route('job.application.store', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label for="expected_salary" :required="true">
                    Mức lương bạn mong muốn
                </x-label>
                <x-text-input type="number" name="expected_salary" />
            </div>
            <div class="mb-4">
                <x-label for="cv" :required="true">Upload CV</x-label>
                <x-text-input type="file" name="cv"/>
            </div>
            <x-button class="w-full">Ứng tuyển</x-button>
        </form>
    </x-card>
</x-layout>
