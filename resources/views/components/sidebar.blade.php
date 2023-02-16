<aside
      class="w-64 transition-transform duration-150 ease-in transform -translate-x-full bg-indigo-500 sidebar md:shadow md:translate-x-0"
    >
      <div class="flex items-center justify-center py-4 sidebar-header">
        <div class="inline-flex">
          <a href="#" class="inline-flex flex-row items-center">
            <svg class="w-10 h-10 text-red-400" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M11.757 2.034a1 1 0 01.638.519c.483.967.844 1.554 1.207 2.03.368.482.756.876 1.348 1.467A6.985 6.985 0 0117 11a7.002 7.002 0 01-14 0c0-1.79.684-3.583 2.05-4.95a1 1 0 011.707.707c0 1.12.07 1.973.398 2.654.18.374.461.74.945 1.067.116-1.061.328-2.354.614-3.58.225-.966.505-1.93.839-2.734.167-.403.356-.785.57-1.116.208-.322.476-.649.822-.88a1 1 0 01.812-.134zm.364 13.087A2.998 2.998 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879.586.585.879 1.353.879 2.121s-.293 1.536-.879 2.121z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="ml-1 text-2xl font-bold leading-10 text-gray-100 uppercase">Logo</span>
          </a>
        </div>
      </div>
      <div class="px-4 py-6 sidebar-content">
        <ul class="flex flex-col w-full">
          <li class="my-px">
            <Link
              href="/"
              class="flex flex-row items-center h-10 px-3 text-gray-700 bg-gray-100 rounded-lg"
            >
              <span class="flex items-center justify-center text-lg text-gray-400">
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
            </Link>
          </li>
          {{ $slot }}
        </ul>
      </div>
    </aside>
