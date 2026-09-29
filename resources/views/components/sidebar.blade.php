<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{url('./images/icon.png')}}" alt="Mali+">
            </span>

            <div class="text header-text">
                <span class="name">Focus+</span>
                <span class="profession">{{ session('usuario_logado', 'Usuário') }}</span>
            </div>
        </div>

        <i class="bx bx-chevron-right toogle"></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-link">
                <li class="nav-link">
                    <a href="{{ route('tasks.index') }}">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="text nav-text">Home</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('diary.index') }}">
                        <i class="bx bx-book-bookmark icon"></i>
                        <span class="text nav-text">Diário</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class="bx bx-chart sine"></i>
                        <span class="text nav-text">Reflexão</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="#">
                        <i class="bx bx-calendar-alt icon"></i>
                        <span class="text nav-text">Agenda</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('hobbies.index') }}">
                        <i class="bx bx-heart icon"></i>
                        <span class="text nav-text">Hobbies</span>
                    </a>
                </li>
                <li class="nav-link">
                <a href="{{ route('dashboard') }}">
                     <i class="bx bx-handshake icon"></i>
                    <span class="text nav-text">Dashboard</span>
                </a>
            </li>
            </ul>
        </div>

        <div class="bottom-content">
            {{-- Minha Conta --}}
            <li class="nav-link">
                <a href="{{ route('conta.show') }}">
                    <i class="bx bx-user-circle icon"></i>
                    <span class="text nav-text">Minha Conta</span>
                </a>
            </li>

            {{-- Logout via POST --}}
            <li class="nav-link logout-item">
                <form method="POST" action="{{ route('auth.logout') }}" id="logoutForm" style="width:100%;height:100%;display:contents;">
                    @csrf
                    <a href="#" class="logout-link"
                       onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class="bx bx-door-open-alt icon"></i>
                        <span class="text nav-text">Sair</span>
                    </a>
                </form>
            </li>
        </div>
    </div>
</nav>

<script src="{{ asset('js/script.js') }}"></script>
