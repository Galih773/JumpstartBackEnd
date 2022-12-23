<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    {{-- Style --}}
    @include('includes.style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    {{-- Sidebar --}}
    <livewire:components.sidebar />

    <div id="right-panel" class="right-panel">

        {{-- Navbar --}}
        <livewire:components.navbar />

        <div class="content">
            {{$slot}}
        </div>
        <div class="clearfix"></div>

    </div>
    
    {{-- Script --}}
    @include('includes.script')

    @livewireScripts
</body>
</html>