@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-r shadow-md animate-fadeInDown" role="alert">
        <div class="flex items-center">
            <span class="text-2xl mr-2">✅</span>
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-r shadow-md animate-fadeInDown" role="alert">
        <div class="flex items-center">
            <span class="text-2xl mr-2">❌</span>
            <p class="font-bold">{{ session('error') }}</p>
        </div>
    </div>
@endif
