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
            <div class="cards">
                <div class="card">
                    <div class="title">
                        <i class="bx bx-sparkles-alt icon"></i>
                        <p>. Como você está se sentindo?</p>
                    </div>

                    <div class="emojis">
                        <i class="bx bx-happy"></i>
                        <i class="bx bx-smile"></i>
                        <i class="bx bx-meh"></i>
                        <i class="bx bx-sad"></i>
                        <i class="bx bx-tired"></i>
                    </div>
                </div>

                <div class="card card-calendario">
                    <div class="title">
                        <i class="bx bx-sparkles-alt icon"></i>

                        <p>Dia da Semana</p>

                         <a href="{{ route('calendario') }}" class="btn-calendario">
                            <i class="bx bx-calendar-alt"></i> Calendário
                         </a>
                    </div>

                    <div class="dias">
                        <p>S</p>
                        <p>T</p>
                        <p>Q</p>
                        <p>Q</p>
                        <p>S</p>
                        <p>S</p>
                        <p>D</p>
                    </div>
                </div>
            </div>

            <div class="menu-home">
                <h1>Minhas Tarefas</h1>

                @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
                @endif

                <div class="addTask">
                    <a href="{{ route('tasks.create') }}"><i class="bx bx-plus bx-remove-padding icon"></i></a>
                </div>
            </div>


            <form action="{{ route('tasks.filterTipos') }}" method="GET">
                @csrf
                @method('GET')
                <p class="filtro-título"><strong>Tipo</strong></p>
                <label class="filtro">
                    <input class="bolinha" type="radio" name="txTipo" value="todas" checked> Todas
                </label>

                @foreach($tipos as $tipo)
                <label class="filtro">
                    <input class="bolinha" type="radio" name="txTipo" value="{{ $tipo->tipo_tarefa }}"> {{ $tipo->tipo_tarefa }}
                </label>
                @endforeach
                <input class="botão-filtrar" type="submit" value="Filtrar">
            </form>
            <form action="{{ route('tasks.filterConcluidas') }}" method="GET">
                @csrf
                @method('GET')
                <p class="filtro-título"><strong>Concluída</strong></p>
                <label class="filtro">
                    <input class="bolinha" type="radio" name="txConcluir" value="todas" checked> Todas
                </label>

                @foreach($concluidas as $concluida)
                <label class="filtro">
                    <input class="bolinha" type="radio" name="txConcluir" value="{{ $concluida->concluida}}"> {{ $concluida->concluida ? 'Sim' : 'Não'}}
                </label>
                @endforeach

                <input class="botão-filtrar" type="submit" value="Filtrar">
            </form>

            <div class="form-por-data">
                <form action="{{ route('tasks.filterPorData') }}" method="GET">
                    <div class="linha-por-data">
                        <p class="filtro-titulo-inline"><strong>Por Data</strong></p>
                        <input type="date" name="data" id="data">
                        <button type="submit" class="botao-filtrar">Filtrar</button>
                    </div>
                </form>
            </div>
            
            <div class="form-entre-datas">
                <form action="{{ route('tasks.filterEntreDatas') }}" method="GET">
                    <p class="filtro-titulo"><strong>Entre Datas</strong></p>

                    <div class="campo-data">
                        <label for="data1">Data Inicial</label>
                        <input type="date" name="data1" id="data1">

                        <label for="data2">Data Final</label>
                        <input type="date" name="data2" id="data2">
                    

                    <button type="submit" class="botao-filtrar">Filtrar</button>
                    </div>
                </form>
            </div>

            <div class="tasks">
                @forelse($tasks as $task)
                <div class="card" onclick="abrirModal('{{ $task->id }}')">
                    <div class="title" style="display:flex;align-items:center;justify-content:space-between;">
                        <h2>{{ $task->nome_tarefa }}</h2>
                        <div class="contentDate">
                            <p class="date">{{ \Carbon\Carbon::parse($task->data_inicio)->format('d/m/Y') }} - </p>
                            <p class="time">- {{ \Carbon\Carbon::parse($task->horario_tarefa)->format('H:i') }}</p>
                        </div>
                    </div>
                    <div class="conteudo">
                        <p>{{ $task->descricao_tarefa }}</p>
                        <p><strong>Tipo:</strong> {{ $task->tipo_tarefa }}</p>
                        <p><strong>Local:</strong> {{ $task->local_tarefa }}</p>
                        <p><strong>Concluída:</strong> {{ $task->concluida ? 'Sim' : 'Não' }}</p>
                    </div>

                    <div class="barra"></div>
                    <div class="rotinas"></div>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $task->id }}" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>{{ $task->nome_tarefa }}</h2>
                            <i class="bx bx-x close-icon" onclick="fecharModal('{{ $task->id }}')"></i>
                        </div>

                        <div class="modal-info">
                            <div class="row">
                                <i class="bx bx-calendar-alt iconModal"></i>
                                <div class="row-date">
                                    <p class="date-title">Data</p>
                                    <p>{{ \Carbon\Carbon::parse($task->data_inicio)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <i class="bx bx-clock iconModal"></i>
                                <div class="row-date">
                                    <p class="date-title">Horário</p>
                                    <p>{{ \Carbon\Carbon::parse($task->horario_tarefa)->format('H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="content-description">
                                <div class="title">
                                    <p>Descrição</p>
                                </div>
                                <p>{{ $task->descricao_tarefa }}</p>
                            </div>

                            <div class="extra">
                                <p><strong>Tipo:</strong> {{ $task->tipo_tarefa }}</p>
                                <p><strong>Local:</strong> {{ $task->local_tarefa }}</p>
                            </div>
                        </div>

                        <div class="modal-actions">
                            <a href="{{ route('tasks.edit', $task->id) }}" onclick="event.stopPropagation()" class="btn editar">
                                <i class="bx bx-edit"></i> Editar
                            </a>

                            <a href="{{ route('tasks.destroy', $task->id) }}"
                                onclick="event.stopPropagation(); event.preventDefault(); if(confirm('Tem certeza?')) { document.getElementById('delete-form-{{ $task->id }}').submit(); }"
                                class="btn excluir">
                                <i class="bx bx-trash"></i> Excluir
                            </a>

                            <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            @if(!$task->concluida)
                            <form id="concluir-form-{{ $task->id }}" action="{{ route('tasks.concluir', $task->id) }}" method="POST" onclick="event.stopPropagation()">
                                @csrf
                                <button type="submit" class="btn concluir">
                                    <i class="bx bx-check"></i> Marcar como concluída
                                </button>
                            </form>
                            @else
                            <span class="btn concluida">
                                <i class="bx bx-check-circle"></i>
                                Concluída
                            </span>
                            @endif
                        </div>

                    </div>
                </div>
                @empty
                <p>Nenhuma tarefa cadastrada.</p>
                @endforelse
            </div>
    </section>

    <script>
        // ---------- Modal de Tarefas (já existente) ----------
        function abrirModal(id) {
            document.getElementById('modal-' + id).classList.add('active');
        }

        function fecharModal(id) {
            document.getElementById('modal-' + id).classList.remove('active');
        }
    </script>
</body>

</html>