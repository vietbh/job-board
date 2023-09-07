<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel Job Board</title>
        @vite(['resources/css/app.css', 'resources/css/app.js'])
    </head>
    <body class="mx-auto mt-10 max-w-2xl bg-slate-200 text-slate-700">
       <x-card class="mb-5 flex justify-between text-2xl font-medium">
                <ul>
                    <li>
                        <x-link-button href="/">Home</x-link-button></li>
                </ul>
                <ul class="flex space-x-2">
                    @auth
                        <li>
                            <x-link-button href="{{ route('my-job-applications.index') }}">
                                {{ auth()->user()->name ?? 'Khách hàng'}}: Applications
                            </x-link-button>
                        </li>
                        <li>
                            <x-button>
                                <a href="{{ route('my-job.index') }}">Công việc</a>
                            </x-button>
                        </li>
                        <li>
                            <form action="{{ route('auth.destroy') }}" method="post">
                            @csrf
                            @method('delete')
                            <x-button>Đăng xuất</x-button>
                            </form>
                        </li>
                    @else
                        <li>
                            <x-button>
                                <a href="{{ route('auth.create') }}">Đăng nhập</a>
                            </x-button>
                        </li>
                    @endauth
                </ul>
       </x-card>
       @if (session('success'))
            <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 
            p-4 text-green-700 opacity-75">
            <p class="font-bold">Success!</p>
            <p>{{session('success')}}</p>
        </div>
       @endif
       @if (session('error'))
            <div role="alert" class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 
            p-4 text-red-700 opacity-75">
            <p class="font-bold">Error!</p>
            <p>{{session('error')}}</p>
        </div>
       @endif
       {{$slot}}
    </body>
</html>
