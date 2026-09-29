<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
</head>

<body>
    @include('components/sidebar')

    <section class="home">
        <div class="header-home">
            <a href="#" class="logo">Focus<span>+</span></a>
        </div>

        <div class="content">
            <div class="menu-home">
                <h1>Usúarios</h1>

                @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
                @endif
            </div>

            <div class="tasks">
                @forelse($usuarios as $usuario)
                <div class="card" onclick="abrirModal('{{ $usuario->id }}')">
                    <div class="title" style="display:flex;align-items:center;justify-content:space-between;">
                        <h2>{{ $usuario->id}} - {{ $usuario->nome_usuario}}</h2>
                    </div>
                    <div class="conteudo">
                        <p><strong>Email:</strong> {{ $usuario->email_usuario}}</p>
                        <p><strong>Data de Nascimento:</strong> {{ $usuario->data_nasc}}</p>
                        <p><strong>Telefone:</strong> {{ $usuario->telefone_usuario}}</p>
                        <p><strong>Cpf:</strong> {{ $usuario->cpf_usuario }}</p>
                    </div>

                    <div class="barra"></div>
                    <div class="rotinas"></div>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $usuario->id }}" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>{{ $usuario->id }} - {{ $usuario->nome_usuario }}</h2>
                            <i class="bx bx-x close-icon" onclick="fecharModal('{{ $usuario->id }}')"></i>
                        </div>

                        <div class="modal-info">
                            <div class="row">
                                <i class="bx bx-envelope iconModal"></i>
                                <div class="row-date">
                                    <p class="date-title">Email</p>
                                    <p>{{ $usuario->email_usuario }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <i class="bx bx-phone iconModal"></i>
                                <div class="row-date">
                                    <p class="date-title">Telefone</p>
                                    <p>{{ $usuario->telefone_usuario }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="extra">
                                <p><strong>CPF:</strong> {{ $usuario->cpf_usuario }}</p>
                            </div>
                        </div>

                        <div class="modal-actions">
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" onclick="event.stopPropagation()" class="btn editar">
                                <i class="bx bx-edit"></i> Editar
                            </a>

                            <a href="{{ route('usuarios.destroy', $usuario->id) }}"
                                onclick="event.stopPropagation(); event.preventDefault(); if(confirm('Tem certeza?')) { document.getElementById('delete-form-{{ $usuario->id }}').submit(); }"
                                class="btn excluir">
                                <i class="bx bx-trash"></i> Excluir
                            </a>

                            <form id="delete-form-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            @empty
            <p>Nenhum usúario cadastrado.</p>
            @endforelse
        </div>

    </section>

    <script src="./js/script.js"></script>
</body>

</html>