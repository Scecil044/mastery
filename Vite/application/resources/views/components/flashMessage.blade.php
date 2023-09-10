@if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="absolute bg-green-600 text-white w-[300px] p-3 top-20 right-0">
        <p>{{ session('message') }}</p>
    </div>
@endif
