<nav class="main-nav">
    <ul>
        <li><a href="/">Simulador</a></li>

        {{-- Muestra los enlaces de administración solo si el usuario es un admin --}}
        @auth
            @if(Auth::user()->role == 'admin')
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Componentes &#9662;</a>
                    <div class="dropdown-content">
                        <a href="{{ route('processors.index') }}">Procesadores</a>
                        <a href="{{ route('motherboards.index') }}">Placas Madre</a>
                        <a href="{{ route('ram-modules.index') }}">Memorias RAM</a>
                        <a href="{{ route('ssds.index') }}">Discos SSD</a>
                    </div>
                </li>
                <li><a href="{{ route('assemblies.index') }}">Historial</a></li>
            @endif
        @endauth
        
        <li><a href="{{ route('camara.index') }}">Cámara</a></li>
    </ul>

    <ul style="margin-left: auto;">
        {{-- Muestra estos enlaces si el usuario es un VISITANTE --}}
        @guest
            <li>
                <a href="{{ route('login') }}">Iniciar Sesión</a>
            </li>
            <li>
                <a href="{{ route('register') }}">Registrarse</a>
            </li>
        @else
            {{-- Muestra esto si el usuario SÍ HA INICIADO SESIÓN --}}
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">
                    {{ Auth::user()->name }} &#9662; </a>

                <div class="dropdown-content">
                    <a href="{{ route('profile.edit') }}">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            Cerrar Sesión
                        </a>
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>