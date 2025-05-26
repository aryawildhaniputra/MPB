@if(session('duplicate_login'))
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-data="{ show: true }" x-show="show">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-4">
        <div class="text-center">
            <div class="mb-4">
                <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Sesi Login Sebelumnya Terputus</h3>
            <p class="text-sm text-gray-600 mb-4">
                Akun Anda telah login di perangkat lain. Sesi sebelumnya telah diakhiri.
            </p>
            <button @click="show = false" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                Mengerti
            </button>
        </div>
    </div>
</div>
@endif
