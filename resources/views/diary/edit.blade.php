<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Diário</title>
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
                <a href="{{ route('diary.index') }}"><i class="bx bx-arrow-back"></i></a>
                <h1>Editar Diário</h1>
            </div>

            <div class="form-max">
                <form action="{{ route('diary.update', $diary->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="field-card">
                        <label><i class="bx bx-sparkles-alt"></i> Títilo do Diário</label>
                        <input type="text" name="title_diary"
                               value="{{ old('title_diary', $diary->title_diary) }}" required>
                    </div>

                    <div class="field-card">
                        <label><i class="bx bx-calendar-alt"></i> Data do Diário</label>
                        <input type="date" name="date_diary"
                               value="{{ old('date_diary', $diary->date_diary) }}">
                    </div>

                    <div class="field-card">
                        <label><i class="bx bx-pencil-draw"></i> Descrição do Diário</label>
                        <textarea name="descricao_diary">{{ old('descricao_diary', $diary->descricao_diary) }}</textarea>
                    </div>

                    <div class="field-card">
                        <label><i class="bx bx-heart"></i> Sentimento</label>
                        <input type="hidden" name="feeling_diary" id="categoria-input"
                               value="{{ old('feeling_diary', $diary->feeling_diary) }}">
                        <div class="categorias">
                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Feliz' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Feliz')">
                                <i class="bx bx-happy"></i> Feliz
                            </button>

                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Triste' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Triste')">
                                <i class="bx bx-sad"></i> Triste
                            </button>

                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Emocionante' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Emocionante')">
                                <i class="bx bx-happy-beaming"></i> Emocionante
                            </button>

                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Estressante' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Estressante')">
                                <i class="bx bx-angry"></i> Estressante
                            </button>

                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Ansioso' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Ansioso')">
                                <i class="bx bx-tired"></i> Ansioso
                            </button>

                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Tedioso' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Tedioso')">
                                <i class="bx bx-meh-alt"></i> Tedioso
                            </button>

                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Animado' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Animado')">
                                <i class="bx bx-laugh"></i> Animado
                            </button>

                            <button type="button" class="cat-btn {{ old('feeling_diary', $diary->feeling_diary) == 'Normal' ? 'selected' : '' }}"
                                    onclick="selecionarCategoria(this, 'Normal')">
                                <i class="bx bx-smile"></i> Normal
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