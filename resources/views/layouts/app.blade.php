<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Reviews</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto my-10 max-w-3xl" x-data="{ flash: true }">
        @if (session()->has('success'))
            <div x-show="flash"
                class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                role="alert"
            >
                <strong class="font-bold">Success!</strong>
                <div>{{ session('success') }}</div>

                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        @click="flash = false"
                        stroke="currentColor"
                        class="h-6 w-6 cursor-pointer"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
        @elseif (session()->has('fail'))
            <div x-show="flash"
                class="relative mb-10 rounded border border-red-400 bg-red-100 px-4 py-3 text-lg text-red-700"
                role="alert"
            >
                <strong class="font-bold">Fail!</strong>
                <div>{{ session('fail') }}</div>

                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        @click="flash = false"
                        stroke="currentColor"
                        class="h-6 w-6 cursor-pointer"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
        @endif

        @yield('content')
    </div>

    @vite(['resources/js/app.js'])
</body>

</html>
