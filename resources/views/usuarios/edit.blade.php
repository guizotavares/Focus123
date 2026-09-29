<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus+ | Editar Cliente</title>
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
                    <h1>Editar Cliente</h1>
                </div>

                @if($errors->any())
                    <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:12px;margin-bottom:16px;font-size:0.85rem;">
                        <ul style="padding-left:16px;">
                            @foreach($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="title-form card">
                        <label><i class="bx bx-user"></i> Nome</label>
                        <input type="text" name="nome_usuario"
                               value="{{ old('nome_usuario', $usuario->nome_usuario) }}"
                               placeholder="Ex: Maria Albuquerque">
                    </div>

                    <div class="description card">
                        <label><i class="bx bx-envelope"></i> Email</label>
                        <input type="email" name="email_usuario"
                               value="{{ old('email_usuario', $usuario->email_usuario) }}"
                               placeholder="Ex: maria@email.com">
                    </div>

                    <div class="date card">
                        <label><i class="bx bx-calendar-alt"></i> Data de Nascimento</label>
                        <input type="date" name="data_nasc"
                               value="{{ old('data_nasc', $usuario->data_nasc) }}">
                    </div>

                    <div class="title-form card">
                        <label><i class="bx bx-id-card"></i> CPF</label>
                        <input type="text" name="cpf_usuario"
                               value="{{ old('cpf_usuario', $usuario->cpf_usuario) }}"
                               placeholder="Ex: 000.000.000-00">
                    </div>

                    {{-- corrigido: name era "tipo_tarefa", value era "$usuario->telefone" --}}
                    <div class="title-form card">
                        <label><i class="bx bx-phone"></i> Telefone</label>
                        <input type="text" name="telefone_usuario"
                               value="{{ old('telefone_usuario', $usuario->telefone_usuario) }}"
                               placeholder="Ex: 11977896554">
                    </div>

                    <div class="button">
                        <button type="submit">
                            <i class="bx bx-save"></i>
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
