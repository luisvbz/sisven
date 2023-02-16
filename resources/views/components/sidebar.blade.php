<aside
      class="w-64 transition-transform duration-150 ease-in transform -translate-x-full bg-gradient-to-b from-primary-800 to-cyan-600 sidebar md:shadow md:translate-x-0"
    >
      <div class="flex items-center justify-center py-4 sidebar-header">
        <div class="inline-flex w-3/4">
          <Link href="/" class="inline-flex flex-row items-center">
            <img src="{{ asset('images/logo-white.svg')}}" alt="logo-white">
          </Link>
        </div>
      </div>
      <div class="px-4 py-6 sidebar-content">
        <ul class="flex flex-col w-full">
          <li class="my-px">
            <x-nav-link-sidebar  :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              <span class="flex items-center justify-center text-lg text-alternative-400">
                <svg
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  />
                </svg>
              </span>
              <span class="ml-3">Inicio</span>
            </x-nav-link-sidebar>
          </li>
          {{ $slot }}
        </ul>
      </div>
    </aside>
