<x-layout>
    <x-breadcrumbs :links="['Công việc của tôi' =>route('my-job.index'),'Tạo công việc' => '#']" class="mb-4" />
    
    <x-card class="mb-8">
        <form action="{{ route('my-job.store') }}" method="post">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">Tiêu đề công việc</x-label>
                    <x-text-input name="title" />
                </div>
                <div>
                    <x-label for="location" :required="true">Địa điểm</x-label>
                    <x-text-input name="location" />
                </div>
                
                <div class="col-span-2">
                    <x-label for="salary" :required="true">Mức lương</x-label>
                    <x-text-input name="salary" type="number" />
                </div>

                <div class="col-span-2">
                    <x-label for="description" :required="true">Mô tả công việc</x-label>
                    <x-text-input name="description" type="textarea" />
                </div>

                <div>
                    <x-label for="experience" :required="true">Kinh nghiệm</x-label>
                    <x-radio-group name="experience" :value="old('experience')" :all-option="false"
                    :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$experience), 
                        \App\Models\Job::$experience)"
                    />
                </div>

                <div>
                    <x-label for="category">Loại công việc</x-label>
                    <x-radio-group name="category" :all-option="false" :options="
                    array_combine(
                        array_map('ucfirst', \App\Models\Job::$category), 
                        \App\Models\Job::$category)
                    " />
                </div>
            </div>
            <div class="col-span-2">
                <x-button class="w-full">Tạo công việc</x-button>
            </div>
        </form>
    </x-card>
</x-layout>