<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Enlace al Simulador (Siempre Visible) --}}
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        {{ __('index') }}
                    </x-nav-link>

                    {{-- Menú Desplegable de Componentes (Siempre Visible) --}}
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>Componentes</div>
                                    <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('processors.index')">{{ __('Procesadores') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('motherboards.index')">{{ __('Placas Madre') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('ram-modules.index')">{{ __('Memorias RAM') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('ssds.index')">{{ __('Discos SSD') }}</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    {{-- Enlace al Historial (Siempre Visible) --}}
                    <x-nav-link :href="route('assemblies.index')" :active="request()->routeIs('assemblies.index')">
                        {{ __('Historial') }}
                    </x-nav-link>

                    {{-- Enlace a la Cámara (Siempre Visible) --}}
                    <x-nav-link :href="route('camara.index')" :active="request()->routeIs('camara.index')">
                        {{ __('Cámara') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- Muestra el nombre y Logout si estás logueado --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Perfil') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Muestra Login y Register si eres visitante --}}
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900">Registrarse</a>
                    @endif
                @endauth
            </div>
            </div>
    </div>
</nav> 