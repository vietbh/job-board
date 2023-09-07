<x-layout>
    <x-breadcrumbs  class="mb-4" :links="['Cong viec'=> route('job.index')]"></x-breadcrumbs>
    <x-card class="mb-4 text-sm">
        <form id="filtering-form" action="{{ route('job.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div >
                    <div class="mb-1 font-semibold">Tim kiem</div>
                    <x-text-input name="search" value="{{request('search')}}"
                     placeholder="Nhap ten cong viec" form-id="filtering-form"/>
                </div>
                <div >
                    <div class="mb-1 font-semibold">Muc luong</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{request('min_salary')}}" placeholder="Thap nhat" form-id="filtering-form"/>
                        <x-text-input name="max_salary" value="{{request('max_salary')}}" placeholder="Cao nhat" form-id="filtering-form"/>
                    </div>
                </div>
                
                <div class="">
                    <div class="mb-1 font-semibold">Kinh nghiệm</div>

                    <x-radio-group name="experience" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$experience), 
                        \App\Models\Job::$experience)" />
                </div>
                <div class="">
                    <div class="mb-1 font-semibold">Loại công việc</div>
    
                    <x-radio-group name="category" :options="
                    array_combine(
                        array_map('ucfirst', \App\Models\Job::$category), 
                        \App\Models\Job::$category)
                    " />   
                </div>
            </div>
            <x-button class="text-xl w-full btn border rounded-md p-2 py-3 hover:bg-blue-400 text-blue-500 font-bold hover:text-white">
                Lọc
            </x-button>
        </form>
    </x-card>
    @forelse ($jobs as $job)
    <x-job-card class="mb-4" :$job>
        <div>
            <x-link-button :href="route('job.show', $job)">
                Xem
            </x-link-button>
        </div>
    </x-job-card>     
    @empty
        <x-card class="text-xl text-red-500 text-center">
        Không có công việc nào    
        </x-card>    
        
    @endforelse 
</x-layout>