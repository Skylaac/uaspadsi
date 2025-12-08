<aside class="w-64 bg-gray-900 text-gray-300 min-h-screen hidden md:flex flex-col">
    <div class="p-4 text-lg font-bold text-white border-b border-gray-700">
        SISKK
    </div>
    <ul class="mt-4 space-y-2 flex-1">
        <li>
            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 hover:bg-gray-800 hover:text-white rounded-md">
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
    <div class="p-4 border-t border-gray-700">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button 
            type="submit"
            class="w-full text-left px-4 py-2 hover:bg-red-600 hover:text-white rounded-md text-red-400"
        >
            Logout
        </button>
    </form>
</div>
</aside>
