<aside class="w-64 bg-gray-900 text-gray-300 min-h-screen hidden md:block">
    <div class="p-4 text-lg font-bold text-white border-b border-gray-700">
        Menu
    </div>
    <ul class="mt-4 space-y-2">
        <li>
            <a href="{{ url('/') }}" class="block px-4 py-2 hover:bg-gray-800 hover:text-white rounded-md">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('absensi.index') }}" class="block px-4 py-2 hover:bg-gray-800 hover:text-white rounded-md">
                Absensi
            </a>
        </li>
        <li>
            <a href="{{ route('jadwal.index') }}"
                class="block px-4 py-2 hover:bg-gray-800 hover:text-white rounded-md">
                Jadwal
            </a>
        </li>
        <li>
             <a href="{{ route('evaluasi.index') }}"
                class="block px-4 py-2 hover:bg-gray-800 hover:text-white rounded-md">
                Evaluasi
            </a>
        </li>
        <li>
             <a href="{{ route('users.index') }}"
                class="block px-4 py-2 hover:bg-gray-800 hover:text-white rounded-md">
                User
            </a>
        </li>
    </ul>
</aside>
