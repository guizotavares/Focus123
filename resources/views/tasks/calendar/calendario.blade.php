<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{url('css/calendario.css')}}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
</head>

<body>
    @include('components/sidebar')
    <section class="home">
        <div class="header-home">
            <a href="{{ url('/') }}" class="logo">Focus<span>+</span></a>
        </div>

        <div class="content cal-page">

            <div class="cal-page-header">
                <div>
                    <h1><i class="bx bx-calendar-heart"></i> Meu Calendário</h1>
                    <p class="cal-page-subtitle">Organize seus dias com carinho</p>
                </div>

                <button type="button" class="cal-novo-evento-btn" onclick="abrirModalEvento()">
                    <i class="bx bx-plus"></i> Novo evento
                </button>
            </div>

            <div class="cal-card">

                <div class="calendario-nav">
                    <button type="button" class="cal-nav-btn" onclick="mudarMes(-1)"><i class="bx bx-chevron-left"></i></button>
                    <div class="calendario-mes-ano">
                        <span id="cal-mes"></span> <span id="cal-ano"></span>
                    </div>
                    <button type="button" class="cal-nav-btn" onclick="mudarMes(1)"><i class="bx bx-chevron-right"></i></button>
                    <button type="button" class="cal-hoje-btn" onclick="irParaHoje()"><i class="bx bx-current-location"></i> Hoje</button>
                </div>

                <div class="calendario-semana">
                    <span>Domingo</span><span>Segunda</span><span>Terça</span><span>Quarta</span><span>Quinta</span><span>Sexta</span><span>Sábado</span>
                </div>

                <div id="calendario-grid" class="calendario-grid"></div>
            </div>
        </div>
    </section>

    <!-- Modal Adicionar/Editar Evento -->
    <div id="modal-evento" class="modal">
        <div class="modal-content calendario-content">
            <div class="modal-header">
                <h2><i class="bx bx-edit-alt cal-title-icon"></i> Novo evento</h2>
                <i class="bx bx-x close-icon" onclick="fecharModalEvento()"></i>
            </div>

            <p class="cal-event-desc">Planeje seu próximo momento especial</p>

            <p class="cal-event-label">Título do evento</p>
            <input type="text" id="cal-event-titulo" class="cal-event-input" placeholder="Ex: Consulta, Aniversário, Passeio...">

            <p class="cal-event-label">Cor do evento</p>
            <div class="cal-event-cores">
                <span class="cal-cor cal-cor-pink selected" data-cor="pink" onclick="selecionarCor(this)" title="Rosa"></span>
                <span class="cal-cor cal-cor-roxo" data-cor="roxo" onclick="selecionarCor(this)" title="Roxo"></span>
                <span class="cal-cor cal-cor-amarelo" data-cor="amarelo" onclick="selecionarCor(this)" title="Amarelo"></span>
                <span class="cal-cor cal-cor-verde" data-cor="verde" onclick="selecionarCor(this)" title="Verde"></span>
            </div>

            <div class="cal-event-datas">
                <div class="cal-event-data-campo">
                    <p class="cal-event-label">Data de início</p>
                    <input type="date" id="cal-event-inicio" class="cal-event-input">
                </div>
                <div class="cal-event-data-campo">
                    <p class="cal-event-label">Data de fim</p>
                    <input type="date" id="cal-event-fim" class="cal-event-input">
                </div>
            </div>

            <div class="cal-event-actions">
                <button type="button" class="btn cal-btn-fechar" onclick="fecharModalEvento()">Fechar</button>
                <button type="button" class="btn cal-btn-salvar" onclick="salvarEvento()"><i class="bx bx-check"></i> Salvar evento</button>
            </div>
        </div>
    </div>

    <script>
        const nomesMeses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        let dataAtual = new Date();
        let diaSelecionado = null; // dia, mes, ano, usado como padrão ao abrir o modal
        let corSelecionada = 'pink';
        let eventos = {}; // 'YYYY-M-D', titulo e cor

        function mudarMes(delta) {
            dataAtual.setMonth(dataAtual.getMonth() + delta);
            renderizarCalendario();
        }
        function irParaHoje() {
            dataAtual = new Date();
            renderizarCalendario();
        }

        function renderizarCalendario() {
            const ano = dataAtual.getFullYear();
            const mes = dataAtual.getMonth();

            document.getElementById('cal-mes').textContent = nomesMeses[mes];
            document.getElementById('cal-ano').textContent = ano;

            const primeiroDiaSemana = new Date(ano, mes, 1).getDay();
            const totalDias = new Date(ano, mes + 1, 0).getDate();
            const totalDiasMesAnterior = new Date(ano, mes, 0).getDate();

            const hoje = new Date();
            const grid = document.getElementById('calendario-grid');
            grid.innerHTML = '';

            for (let i = primeiroDiaSemana - 1; i >= 0; i--) {
                grid.appendChild(criarCelula(totalDiasMesAnterior - i, true, mes - 1, ano));
            }
            for (let d = 1; d <= totalDias; d++) {
                const ehHoje = d === hoje.getDate() && mes === hoje.getMonth() && ano === hoje.getFullYear();
                grid.appendChild(criarCelula(d, false, mes, ano, ehHoje));
            }
            const totalCelulas = primeiroDiaSemana + totalDias;
            const restante = (7 - (totalCelulas % 7)) % 7;
            for (let d = 1; d <= restante; d++) {
                grid.appendChild(criarCelula(d, true, mes + 1, ano));
            }
        }

        function criarCelula(dia, outroMes, mes, ano, ehHoje) {
            const div = document.createElement('div');
            div.classList.add('cal-dia');
            if (outroMes) div.classList.add('cal-dia-outro-mes');
            if (ehHoje) div.classList.add('cal-dia-hoje');

            const numero = document.createElement('span');
            numero.classList.add('cal-dia-numero');
            numero.textContent = dia;
            div.appendChild(numero);

            const chave = chaveData(ano, mes, dia);
            const listaEventos = eventos[chave] || [];

            const eventosContainer = document.createElement('div');
            eventosContainer.classList.add('cal-dia-eventos');

            const maxVisiveis = 3;
            listaEventos.slice(0, maxVisiveis).forEach(ev => {
                const pill = document.createElement('span');
                pill.classList.add('cal-evento-pill', 'cal-evento-' + ev.cor);
                pill.textContent = ev.titulo;
                eventosContainer.appendChild(pill);
            });
            if (listaEventos.length > maxVisiveis) {
                const mais = document.createElement('span');
                mais.classList.add('cal-evento-mais');
                mais.textContent = '+' + (listaEventos.length - maxVisiveis) + ' mais';
                eventosContainer.appendChild(mais);
            }
            div.appendChild(eventosContainer);

            div.addEventListener('click', () => {
                diaSelecionado = { dia, mes, ano };
                abrirModalEvento();
            });
            return div;
        }

        function chaveData(ano, mes, dia) {
            const d = new Date(ano, mes, dia);
            return d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate();
        }

        function formatarInputData(ano, mes, dia) {
            const d = new Date(ano, mes, dia);
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const dd = String(d.getDate()).padStart(2, '0');
            return d.getFullYear() + '-' + mm + '-' + dd;
        }

        function abrirModalEvento() {
            document.getElementById('cal-event-titulo').value = '';
            document.querySelectorAll('.cal-cor').forEach(c => c.classList.remove('selected'));
            document.querySelector('.cal-cor-pink').classList.add('selected');
            corSelecionada = 'pink';

            const base = diaSelecionado || { dia: dataAtual.getDate(), mes: dataAtual.getMonth(), ano: dataAtual.getFullYear() };
            const dataFormatada = formatarInputData(base.ano, base.mes, base.dia);
            document.getElementById('cal-event-inicio').value = dataFormatada;
            document.getElementById('cal-event-fim').value = dataFormatada;

            document.getElementById('modal-evento').classList.add('active');
        }

        function fecharModalEvento() {
            document.getElementById('modal-evento').classList.remove('active');
            diaSelecionado = null;
        }

        function selecionarCor(el) {
            document.querySelectorAll('.cal-cor').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            corSelecionada = el.dataset.cor;
        }

        function salvarEvento() {
            const titulo = document.getElementById('cal-event-titulo').value.trim();
            const inicio = document.getElementById('cal-event-inicio').value;
            const fim = document.getElementById('cal-event-fim').value || inicio;
            if (!titulo || !inicio) return;

            let atual = new Date(inicio + 'T00:00:00');
            const dataFim = new Date(fim + 'T00:00:00');

            while (atual <= dataFim) {
                const chave = atual.getFullYear() + '-' + atual.getMonth() + '-' + atual.getDate();
                if (!eventos[chave]) eventos[chave] = [];
                eventos[chave].push({ titulo, cor: corSelecionada });
                atual.setDate(atual.getDate() + 1);
            }

            fecharModalEvento();
            renderizarCalendario();
        }

        document.getElementById('modal-evento').addEventListener('click', function(e) {
            if (e.target === this) fecharModalEvento();
        });

        renderizarCalendario();
    </script>
</body>
</html>