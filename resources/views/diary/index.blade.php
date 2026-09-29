<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Diários</title>
    <link rel="stylesheet" href="{{url('css/diary.css')}}">
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
            <div class="hobbies-header">
                <h1>Meus Diários</h1>
                <div class="book-icon">
                    <i class="bx bx-book"></i>
                </div>
            </div>

            <div class="diary-create">
                <div class="diary-format">
                    <p class="create-subtitle">{{ now()->format('d/m/Y') }}</p>
                </div>
                <div class="diary-format">
                    <p>Capture os momentos do seu dia!</p>
                </div>
                <div class="diary-format">
                    <a href="{{ route('diary.create') }}" class="btn-add">
                        <i class="bx bx-pencil-draw" style="color: #ffea00;"></i>
                        <p class="create-text">Gravar agora</p>
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="hobbies-list" id="hobbies-list">
                @forelse($diary->sortByDesc('date_diary') as $diary)
                <!-- mudar a cor do icone -->
                @php
                $corIcone = match($diary->feeling_diary) {
                'Feliz' => 'verde',
                'Triste' => 'azul',
                'Emocionante' => 'laranja',
                'Estressante' => 'vermelho',
                'Ansioso' => 'amarelo',
                'Tedioso' => 'cinza',
                'Animado' => 'rosa',
                'Normal' => 'roxo',
                default => '',
                };

                $icone = match($diary->feeling_diary) {
                'Feliz' => 'bx bx-happy',
                'Triste' => 'bx bx-sad',
                'Emocionante' => 'bx bx-happy-beaming',
                'Estressante' => 'bx bx-angry',
                'Ansioso' => 'bx bx-tired',
                'Tedioso' => 'bx bx-meh-alt',
                'Animado' => 'bx bx-laugh',
                'Normal' => 'bx bx-smile',
                default => '',
                };


                @endphp

                <div class="hobby-card" data-categoria="{{ $diary->feeling_diary }}" onclick="abrirModal('{{ $diary->id }}')">
                    <div class="hobby-icon {{ $corIcone }}">
                        <i class="{{ $icone }}"></i>
                    </div>

                    <div class="hobby-info">
                        <div class="hobby-nome">
                            <p>{{ $diary->title_diary }}</p>
                            <p class="date">{{ \Carbon\Carbon::parse($diary->date_diary)->format('d/m/Y') }}</p>
                        </div>
                        <div class="hobby-meta">{{ $diary->descricao_diary ?? 'Sem descrição' }}</div>
                        <div class="progresso-label">
                        </div>
                        <div class="barra-bg">
                            <div class="barra-fill" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $diary->id }}" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>{{ $diary->title_diary }}</h2>
                            <i class="bx bx-x close-icon" onclick="fecharModal('{{ $diary->id }}')"></i>
                        </div>

                        <div class="modal-info">
                            <div class="row">
                                <i class="bx bx-calendar-alt iconModal"></i>
                                <div class="row-date">
                                    <p class="date-title">Data</p>
                                    <p>{{ \Carbon\Carbon::parse($diary->date_diary)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="content-description">
                                <div class="title">
                                    <p>Descrição</p>
                                </div>
                                <p>{{ $diary->descricao_diary }}</p>
                            </div>

                            <div class="extra">
                                <p><strong>Sentimento:</strong> {{ $diary->feeling_diary }}</p>
                            </div>
                        </div>

                        <div class="modal-actions">
                            <a href="{{ route('diary.edit', $diary->id) }}" onclick="event.stopPropagation()" class="btn editar">
                                <i class="bx bx-edit"></i> Editar
                            </a>

                            <a href="{{ route('diary.destroy', $diary->id) }}"
                                onclick="event.stopPropagation(); event.preventDefault(); if(confirm('Tem certeza?')) { document.getElementById('delete-form-{{ $diary->id }}').submit(); }"
                                class="btn excluir">
                                <i class="bx bx-trash"></i> Excluir
                            </a>

                            <form id="delete-form-{{ $diary->id }}" action="{{ route('diary.destroy', $diary->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>

                    </div>
                </div>

                @empty
                <div class="empty" id="empty-msg">
                    <p>Nenhum diário cadastrado ainda.</p>
                </div>
                @endforelse
            </div>

        </div>
    </section>

    <script>
        const body = document.querySelector("body");
        const sidebar = body.querySelector(".sidebar");
        const toogle = body.querySelector(".toogle");

        toogle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        function abrirModal(id) {
            const modal = document.getElementById('modal-' + id);
            if (modal) {
                modal.classList.add('active');
            }
        }

        function fecharModal(id) {
            const modal = document.getElementById('modal-' + id);
            if (modal) {
                modal.classList.remove('active');
            }
        }

        document.addEventListener('click', function(e) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>