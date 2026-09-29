<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus+ | Minha Conta</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{url('css/conta-show.css')}}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
</head>
<body>
    @include('components/sidebar')

    <section class="home">

        <div class="header-home">
            <a href="./index.html" class="logo">Focus<span>+</span></a>
        </div>

        <!-- Corpo da página -->
        <div class="page-body">

            <!-- Painel esquerdo: card do perfil -->
            <div class="profile-panel">
                <div class="profile-card">
                    <div class="avatar-wrap">
                        <div class="avatar">
                            {{ strtoupper(substr($usuario->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                    <div class="profile-name">{{ $usuario->name }}</div>
                    <div class="profile-email">{{ $usuario->email }}</div>
                    <div class="profile-since">
                        <i class="bx bx-time-five"></i>
                        Membro desde {{ $usuario->created_at ? $usuario->created_at->format('M/Y') : '—' }}
                    </div>
                    <a href="{{ route('conta.edit') }}" class="edit-btn">
                        <i class="bx bx-edit"></i> Editar conta
                    </a>
                </div>

                <div class="info-chip">
                    <div class="info-chip-icon"><i class="bx bx-user-id-card"></i></div>
                    <div>
                        <div class="info-chip-label">CPF</div>
                        <div class="info-chip-value">{{ $usuario->cpf ?? '—' }}</div>
                    </div>
                </div>

                <div class="info-chip">
                    <div class="info-chip-icon"><i class="bx bx-phone"></i></div>
                    <div>
                        <div class="info-chip-label">Telefone</div>
                        <div class="info-chip-value">{{ $usuario->telefone ?? '—' }}</div>
                    </div>
                </div>

                <div class="info-chip">
                    <div class="info-chip-icon"><i class="bx bx-birthday-cake"></i></div>
                    <div>
                        <div class="info-chip-label">Nascimento</div>
                        <div class="info-chip-value">
                            {{ $usuario->data_nasc ? \Carbon\Carbon::parse($usuario->data_nasc)->format('d/m/Y') : '—' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Painel direito: detalhes e tarefas -->
            <div class="main-panel">

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bx bx-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- Informações da conta -->
                <div class="section-card">
                    <div class="section-head">
                        <div class="section-head-left">
                            <div class="section-head-icon"><i class="bx bx-user"></i></div>
                            <div>
                                <h2>Informações da Conta</h2>
                                <p>Seus dados cadastrados no Focus+</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-item-label"><i class="bx bx-user"></i> Nome</div>
                            <div class="info-item-value">{{ $usuario->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="bx bx-envelope"></i> E-mail</div>
                            <div class="info-item-value">{{ $usuario->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="bx bx-phone"></i> Telefone</div>
                            <div class="info-item-value">{{ $usuario->telefone ?? '—' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="bx bx-birthday-cake"></i> Data de Nascimento</div>
                            <div class="info-item-value">
                                {{ $usuario->data_nasc ? \Carbon\Carbon::parse($usuario->data_nasc)->format('d/m/Y') : '—' }}
                            </div>
                        </div>
                        <div class="info-item" style="border-bottom:none;">
                            <div class="info-item-label"><i class="bx bx-user-id-card"></i> CPF</div>
                            <div class="info-item-value">{{ $usuario->cpf ?? '—' }}</div>
                        </div>
                        <div class="info-item" style="border-bottom:none;">
                            <div class="info-item-label"><i class="bx bx-calendar"></i> Membro desde</div>
                            <div class="info-item-value">
                                {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : '—' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarefas registradas -->
                <div class="section-card">
                    <div class="section-head">
                        <div class="section-head-left">
                            <div class="section-head-icon"><i class="bx bx-check"></i></div>
                            <div>
                                <h2>Minhas Tarefas</h2>
                                <p>{{ $tasks->count() }} tarefa(s) registrada(s)</p>
                            </div>
                        </div>
                        <a href="{{ route('tasks.index') }}" class="view-all">
                            Ver todas <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>

                    @if($tasks->isEmpty())
                        <div class="no-tasks">
                            <i class="bx bx-task"></i>
                            Nenhuma tarefa registrada ainda.
                        </div>
                    @else
                        <div class="tasks-list">
                            @foreach($tasks->take(8) as $task)
                                <div class="task-item">
                                    <div class="task-dot"></div>
                                    <div class="task-info">
                                        <div class="task-name">{{ $task->nome_tarefa }}</div>
                                        <div class="task-meta">
                                            @if($task->data_inicio)
                                                <i class="bx bx-calendar-alt" style="font-size:11px;"></i>
                                                {{ \Carbon\Carbon::parse($task->data_inicio)->format('d/m/Y') }}
                                            @endif
                                            @if($task->tipo_tarefa)
                                                · {{ $task->tipo_tarefa }}
                                            @endif
                                        </div>
                                    </div>
                                    <span class="task-badge {{ $task->concluida ? 'done' : '' }}">
                                        {{ $task->concluida ? 'Concluída' : 'Pendente' }}
                                    </span>
                                </div>
                            @endforeach

                            @if($tasks->count() > 8)
                                <div style="text-align:center; padding: 8px 0;">
                                    <a href="{{ route('tasks.index') }}" class="view-all">
                                        + {{ $tasks->count() - 8 }} tarefas a mais
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
            {{-- Fim do main-panel --}}

        </div>
        {{-- Fim do page-body --}}

    </section>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
