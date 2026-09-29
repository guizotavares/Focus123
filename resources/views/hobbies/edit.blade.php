<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Hobby</title>
    <link rel="stylesheet" href="{{url('css/hobbies.css')}}">
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
            <div class="form-header">
                <a href="{{ route('hobbies.index') }}"><i class="bx bx-arrow-back"></i></a>
                <h1>Editar Hobby</h1>
            </div>

            <div class="form-max">
                <form action="{{ route('hobbies.update', $hobby->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="field-card">
                        <label><i class="bx bx-sparkles-alt"></i> Nome do Hobby</label>
                        <input type="text" name="nome_hobby"
                               value="{{ old('nome_hobby', $hobby->nome_hobby) }}" required>
                    </div>

                    <div class="field-card">
                        <label><i class="bx bx-target-lock"></i> Meta / Objetivo</label>
                        <input type="text" name="meta"
                               value="{{ old('meta', $hobby->meta) }}">
                    </div>

                    <div class="field-card">
                        <label><i class="bx bx-heart"></i> Categoria</label>
                        <input type="hidden" name="categoria" id="categoria-input"
                               value="{{ old('categoria', $hobby->categoria) }}">
                        <div class="categorias">
                            <button type="button" class="cat-btn {{ old('categoria', $hobby->categoria) == 'Aprendizado' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Aprendizado')">
                                <i class="bx bx-book-open"></i> Aprendizado
                            </button>
                            <button type="button" class="cat-btn {{ old('categoria', $hobby->categoria) == 'Criativo' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Criativo')">
                                <i class="bx bx-palette"></i> Criativo
                            </button>
                            <button type="button" class="cat-btn {{ old('categoria', $hobby->categoria) == 'Bem-estar' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Bem-estar')">
                                <i class="bx bx-coffee"></i> Bem-estar
                            </button>
                            <button type="button" class="cat-btn {{ old('categoria', $hobby->categoria) == 'Fitness' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Fitness')">
                                <i class="bx bx-dumbbell"></i> Fitness
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-salvar">
                        <i class="bx bx-save"></i> Salvar alterações
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        function selecionarCategoria(btn, valor) {
            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('selected'))
            btn.classList.add('selected')
            document.getElementById('categoria-input').value = valor
        }
    </script>
</body>
</html>