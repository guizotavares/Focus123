<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Hobbies</title>
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

            <div class="hobbies-header">
                <h1>Meus Hobbies</h1>
                <a href="{{ route('hobbies.create') }}" class="btn-add">
                    <i class="bx bx-plus"></i>
                </a>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number">{{ $hobbies->count() }}</div>
                    <div class="stat-label">Hobbies</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $hobbies->where('categoria', 'Fitness')->count() }}</div>
                    <div class="stat-label">Fitness</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $hobbies->where('categoria', 'Aprendizado')->count() }}</div>
                    <div class="stat-label">Aprendizado</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $hobbies->where('categoria', 'Criativo')->count() }}</div>
                    <div class="stat-label">Criativo</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $hobbies->where('categoria', 'Bem-estar')->count() }}</div>
                    <div class="stat-label">Bem-estar</div>
                </div>
            </div>

            <div class="filtros">
                <a href="#" class="filtro-btn active" onclick="filtrar(event, 'todos')">
                    <i class="bx bx-heart"></i> Todos
                </a>
                <a href="#" class="filtro-btn" onclick="filtrar(event, 'Aprendizado')">
                    <i class="bx bx-book-open"></i> Aprendizado
                </a>
                <a href="#" class="filtro-btn" onclick="filtrar(event, 'Criativo')">
                    <i class="bx bx-palette"></i> Criativo
                </a>
                <a href="#" class="filtro-btn" onclick="filtrar(event, 'Bem-estar')">
                    <i class="bx bx-coffee"></i> Bem-estar
                </a>
                <a href="#" class="filtro-btn" onclick="filtrar(event, 'Fitness')">
                    <i class="bx bx-dumbbell"></i> Fitness
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="hobbies-list" id="hobbies-list">
                @forelse($hobbies as $hobby)
                <!-- mudar a cor do icone -->
                    <div class="hobby-card" data-categoria="{{ $hobby->categoria }}">
                        <div class="hobby-icon {{ $hobby->categoria == 'Bem-estar' ? 'verde' : ($hobby->categoria == 'Criativo' ? 'roxo' : ($hobby->categoria == 'Fitness' ? 'laranja' : '')) }}">
                            <i class="bx bx-heart"></i>
                        </div>

                        <div class="hobby-info">
                            <div class="hobby-nome">{{ $hobby->nome_hobby }}</div>
                            <div class="hobby-meta">{{ $hobby->meta ?? 'Sem meta definida' }}</div>
                            <div class="progresso-label">
                                <span>Progresso semanal</span>
                                <span>0%</span>
                            </div>
                            <div class="barra-bg">
                                <div class="barra-fill" style="width: 0%"></div>
                            </div>
                        </div>

                        <div class="hobby-actions">
                            <a href="{{ route('hobbies.edit', $hobby->id) }}" class="btn-acao editar">
                                <i class="bx bx-edit"></i> Editar
                            </a>
                            <form action="{{ route('hobbies.destroy', $hobby->id) }}" method="POST"
                                  onsubmit="return confirm('Excluir este hobby?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-acao excluir">
                                    <i class="bx bx-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty" id="empty-msg">
                        <p>Nenhum hobby cadastrado ainda.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <script>
        function filtrar(event, categoria) {
            event.preventDefault()

            // atualiza botões ativos
            document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('active'))
            event.currentTarget.classList.add('active')

            // mostra/esconde cards
            const cards = document.querySelectorAll('.hobby-card')
            let visiveis = 0

            cards.forEach(card => {
                if (categoria === 'todos' || card.dataset.categoria === categoria) {
                    card.style.display = 'flex'
                    visiveis++
                } else {
                    card.style.display = 'none'
                }
            })

            // mostra mensagem se nenhum resultado
            const emptyMsg = document.getElementById('empty-msg')
            if (emptyMsg) {
                emptyMsg.style.display = visiveis === 0 ? 'block' : 'none'
            }
        }
    </script>
</body>
</html>