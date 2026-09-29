<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <link rel="stylesheet" href="{{url('css/form.css')}}">
    <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
</head>
<body>
    @include('components/sidebar')

    <section class="home">
        <div class="header-home">
            <a href="./index.html" class="logo">Focus<span>+</span></a>
        </div>

        <div class="content">
            <div class="form">
                <div class="title">
                    <i class="bx bx-sparkles-alt icon"></i>
                    <h1>Criar nova Tarefa</h1>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="title-form card">
                        <label>
                            <i class="bx bx-price-tag-alt"></i>
                            Título
                        </label>
                        <input type="text" name="nome_tarefa" placeholder="Ex: Reunião importante" required>
                    </div>

                    <div class="description card">
                        <label>
                            <i class="bx bx-captions"></i>
                            Descrição
                        </label>
                        <textarea name="descricao_tarefa" placeholder="Adicione mais detalhes..."></textarea>
                    </div>

                    <div class="row">
                        <div class="date card">
                            <label>
                                <i class="bx bx-calendar-alt"></i>
                                Data de início
                            </label>
                            <input type="date" name="data_inicio" required>
                        </div>
                        <div class="time card">
                            <label>
                                <i class="bx bx-clock"></i>
                                Horário
                            </label>
                            <input type="time" name="horario_tarefa">
                        </div>
                    </div>
                    <div class="title-form card">
                        <label>
                            <i class="bx bx-price-tag-alt"></i>
                            Tipo
                        </label>
                        <input type="text" name="tipo_tarefa" placeholder="Ex: Estudo, Trabalho, Lazer..." required>
                    </div>
                    <div class="place card">
                        <label>
                            <i class="bx bx-location-plus"></i>
                            Local
                        </label>
                        <input type="text" name="local_tarefa" placeholder="Ex: Escritório, Casa, Apartamento etc..." required>
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