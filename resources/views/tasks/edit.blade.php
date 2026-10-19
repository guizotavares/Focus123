<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tarefa</title>
    <link rel="stylesheet" href="{{url('css/form.css')}}">
    <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
</head>
<body>
    @include('components/sidebar')

    <section class="home">
        <div class="header-home">
            <a href="{{ route('tasks.index') }}" class="logo">Focus<span>+</span></a>
        </div>

        <div class="content">
            <div class="form">
                <div class="title">
                    <i class="bx bx-sparkles-alt icon"></i>
                    <h1>Editar Tarefa</h1>
                </div>

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Erros de validação (vindos do TaskFormRequest) --}}
                    @include('components/erros')

                    <div class="title-form card">
                        <label>
                            <i class="bx bx-price-tag-alt"></i>
                            Título
                        </label>
                        <input type="text" name="nome_tarefa"
                               value="{{ old('nome_tarefa', $task->nome_tarefa) }}"
                               placeholder="Ex: Reunião importante">
                    </div>

                    <div class="description card">
                        <label>
                            <i class="bx bx-captions"></i>
                            Descrição
                        </label>
                        <textarea name="descricao_tarefa" placeholder="Adicione mais detalhes...">{{ old('descricao_tarefa', $task->descricao_tarefa) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="date card">
                            <label>
                                <i class="bx bx-calendar-alt"></i>
                                Data de início
                            </label>
                            <input type="date" name="data_inicio"
                                   value="{{ old('data_inicio', $task->data_inicio) }}">
                        </div>
                        <div class="time card">
                            <label>
                                <i class="bx bx-clock"></i>
                                Horário
                            </label>
                            {{-- O banco guarda HH:MM:SS; cortamos para HH:MM,
                                 senão a regra date_format:H:i reprova. --}}
                            <input type="time" name="horario_tarefa"
                                   value="{{ old('horario_tarefa', $task->horario_tarefa ? substr($task->horario_tarefa, 0, 5) : '') }}">
                        </div>
                    </div>

                    <div class="title-form card">
                        <label>
                            <i class="bx bx-price-tag-alt"></i>
                            Tipo
                        </label>
                        <input type="text" name="tipo_tarefa"
                               value="{{ old('tipo_tarefa', $task->tipo_tarefa) }}"
                               placeholder="Ex: Estudo, Trabalho, Lazer...">
                    </div>

                    <div class="place card">
                        <label>
                            <i class="bx bx-location-plus"></i>
                            Local
                        </label>
                        <input type="text" name="local_tarefa"
                               value="{{ old('local_tarefa', $task->local_tarefa) }}"
                               placeholder="Ex: Escritório, Casa, Apartamento etc...">
                    </div>

                    <div class="button">
                        <button type="submit">
                            <i class="bx bx-save"></i>
                            Salvar Tarefa
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </section>
</body>
</html>