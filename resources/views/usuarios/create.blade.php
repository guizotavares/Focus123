<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus+</title>
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
                    <h1>Criar Conta</h1>
                </div>
                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf

                    <div class="title-form card">
                        <label>
                            <i class="bx bx-price-tag-alt"></i>
                            Nome
                        </label>
                        <input type="text" name="nome_usuario" placeholder="Ex: Maria Albuquerque">
                    </div>

                    <div class="description card">
                        <label>
                            <i class="bx bx-captions"></i>
                            Email
                        </label>
                        <input type="email" name="email_usuario" placeholder="Ex: mariaalbuquerque@gmail.com">
                    </div>
                        <div class="date card">
                            <label>
                                <i class="bx bx-calendar-alt"></i>
                                Data de Nascimento 
                            </label>
                            <input type="date" name="data_nasc">
                        </div>

                    <div class="title-form card">
                        <label>
                            <i class="bx bx-price-tag-alt"></i>
                            CPF
                        </label>
                        <input type="text" name="cpf_usuario" placeholder="Ex: 67892789276">
                    </div>

                    <div class="place card">
                        <label>
                            <i class="bx bx-location-plus"></i>
                            Telefone
                        </label>
                        <input type="text" name="telefone_usuario" placeholder="Ex:11977896554...">
                    </div>

                    <div class="button">
                        <button type="submit">
                            <i class="bx bx-save"></i>
                            Criar Conta
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</body>
</html>