<div class="fixed bottom-0 left-0 justify-center w-full z-50 bg-[#B1D0E0] rounded-t-4xl">
    <nav class="w-full flex justify-around items-center p-6">

        <a href="url{}" class="group flex items-center justify-center w-14 h-14 rounded-full transition-all duration-500 ease-in-out hover:w-40 hover:bg-[#1A374D] hover:text-white overflow-hidden">
          <div class="flex justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" class="fill-current text-[#1A374C] group-hover:text-white transition-colors duration-500">
                <path d="M13.26 3C8.17 2.86 4 6.95 4 12H2.21c-.45 0-.67.54-.35.85l2.79 2.8c.2.2.51.2.71 0l2.79-2.8a.5.5 0 0 0-.36-.85H6c0-3.9 3.18-7.05 7.1-7c3.72.05 6.85 3.18 6.9 6.9c.05 3.91-3.1 7.1-7 7.1c-1.61 0-3.1-.55-4.28-1.48a.994.994 0 0 0-1.32.08c-.42.42-.39 1.13.08 1.49A8.86 8.86 0 0 0 13 21c5.05 0 9.14-4.17 9-9.26c-.13-4.69-4.05-8.61-8.74-8.74m-.51 5c-.41 0-.75.34-.75.75v3.68c0 .35.19.68.49.86l3.12 1.85c.36.21.82.09 1.03-.26c.21-.36.09-.82-.26-1.03l-2.88-1.71v-3.4c0-.4-.34-.74-.75-.74" />
            </svg>
          </div>
          <span class="max-w-0 overflow-hidden whitespace-nowrap opacity-0 transition-all duration-500 ease-in-out group-hover:max-w-xs group-hover:opacity-100 group-hover:ml-3 font-semibold">
              History
          </span>
        </a>

        <a href="{{ route('home')}}" class="group flex items-center justify-center w-14 h-14 rounded-full transition-all duration-500 ease-in-out hover:w-40 hover:bg-[#1A374D] hover:text-white  overflow-hidden
                                            {{ request()->routeIs('home') ? 'bg-[#1A374D] text-white w-40' : '' }}">
          <div class="flex justify-center shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" 
                   class="fill-current text-[#1A374C] group-hover:text-white transition-colors duration-500
                          {{ request()->routeIs('home') ? 'text-white' : 'text-[#1A374C] group-hover:text-white' }}">
	              <path d="M4 19v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-3q-.425 0-.712-.288T14 20v-5q0-.425-.288-.712T13 14h-2q-.425 0-.712.288T10 15v5q0 .425-.288.713T9 21H6q-.825 0-1.412-.587T4 19" />
              </svg>
          </div>
          <span class="max-w-0 overflow-hidden whitespace-nowrap opacity-0 transition-all duration-500 ease-in-out group-hover:max-w-xs group-hover:opacity-100 group-hover:ml-3 font-semibold">
              Home
          </span>
        </a>

        <a href="#" class="group flex items-center justify-center w-14 h-14 rounded-full transition-all duration-500 ease-in-out hover:w-40 hover:bg-[#1A374C] hover:text-white overflow-hidden">
          <div class="flex justify center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" class="fill-current text-[#1A374C] group-hover:text-white transition-colors duration-500">
	            <path fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd" />
            </svg>
          </div>

          <span class="max-w-0 overflow-hidden whitespace-nowrap opacity-0 transition-all duration-500 ease-in-out group-hover:max-w-xs group-hover:opacity-100 grou-hover ml-3 font-semibold">
            Profile
          </span>
        </a>
          
    </nav>
</div>