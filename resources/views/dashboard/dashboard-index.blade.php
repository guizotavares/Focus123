<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus+ | Dashboard</title>
    <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

    <style>
        :root {
            --bg:          #090D18;
            --surface:     #0E1525;
            --surface-2:   #14203A;
            --surface-3:   #1A2B4A;
            --blue:        #2563EB;
            --blue-mid:    #3B82F6;
            --blue-light:  #60A5FA;
            --blue-pale:   rgba(37, 99, 235, 0.08);
            --blue-glow:   rgba(59, 130, 246, 0.20);
            --text:        #E8EDF5;
            --text-muted:  #5A6B8A;
            --border:      rgba(59, 130, 246, 0.12);
        }

        * {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
        }

        body { background: var(--bg); color: var(--text); }

        .home {
            position: relative;
            left: 250px;
            width: calc(100% - 250px);
            background: var(--bg);
            min-height: 100vh;
        }

        .sidebar.close ~ .home {
            left: 88px;
            width: calc(100% - 88px);
        }

        .header-home {
            background: var(--surface);
            padding: 0 48px;
            height: 64px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .logo span { color: var(--blue-mid); }

        .content { padding: 36px 48px 56px; }

        .dash-header { margin-bottom: 28px; }

        .dash-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: 0.5px;
        }

        .dash-header p {
            color: var(--text-muted);
            font-size: 13px;
            margin-top: 4px;
        }

        .dash-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .dash-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 22px 24px 8px;
            transition: border-color 0.2s;
        }

        .dash-card:hover {
            border-color: rgba(59, 130, 246, 0.28);
        }

        .dash-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
        }

        .dash-card-title-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--blue-pale);
            border: 1px solid rgba(59, 130, 246, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: var(--blue-light);
        }

        .dash-card-title h2 {
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }

        .dash-chart {
            width: 100%;
            height: 340px;
        }

        .dash-empty {
            height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 13px;
        }

        @media (max-width: 1000px) {
            .dash-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .home { left: 0; width: 100%; }
            .sidebar.close ~ .home { left: 0; width: 100%; }
            .header-home { padding: 0 24px; }
            .content { padding: 24px; }
        }
    </style>
</head>
<body>
    @include('components/sidebar')

    <section class="home">
        <div class="header-home">
            <a href="{{ route('tasks.index') }}" class="logo">Focus<span>+</span></a>
        </div>

        <div class="content">
            <div class="dash-header">
                <h1><i class="bx bx-bar-chart-alt-2"></i> Dashboard</h1>
                <p>Visão geral dos seus dados no Focus+</p>
            </div>

            <div class="dash-grid">

                {{-- 1. GRÁFICO DE PIZZA — Tarefas por Tipo --}}
                <div class="dash-card">
                    <div class="dash-card-title">
                        <div class="dash-card-title-icon"><i class="bx bx-pie-chart-alt"></i></div>
                        <h2>Tarefas por Tipo</h2>
                    </div>
                    @if($tarefasPorTipo->isEmpty())
                        <div class="dash-empty">Nenhuma tarefa cadastrada ainda.</div>
                    @else
                        <div id="chart-tarefas-tipo" class="dash-chart"></div>
                    @endif
                </div>

                {{-- 2. GRÁFICO DE BARRAS — Hobbies por Categoria --}}
                <div class="dash-card">
                    <div class="dash-card-title">
                        <div class="dash-card-title-icon"><i class="bx bx-bar-chart"></i></div>
                        <h2>Hobbies por Categoria</h2>
                    </div>
                    @if($hobbiesPorCategoria->isEmpty())
                        <div class="dash-empty">Nenhum hobby cadastrado ainda.</div>
                    @else
                        <div id="chart-hobbies-categoria" class="dash-chart"></div>
                    @endif
                </div>

                {{-- 3. GRÁFICO DE LINHA — Tarefas criadas por data --}}
                <div class="dash-card">
                    <div class="dash-card-title">
                        <div class="dash-card-title-icon"><i class="bx bx-trending-up"></i></div>
                        <h2>Tarefas Criadas por Data</h2>
                    </div>
                    @if($tarefasPorData->isEmpty())
                        <div class="dash-empty">Nenhuma tarefa com data cadastrada.</div>
                    @else
                        <div id="chart-tarefas-data" class="dash-chart"></div>
                    @endif
                </div>

                {{-- 4. GRÁFICO DE ROSCA (DONUT) — Diário por Sentimento --}}
                <div class="dash-card">
                    <div class="dash-card-title">
                        <div class="dash-card-title-icon"><i class="bx bx-donut-chart"></i></div>
                        <h2>Diário por Sentimento</h2>
                    </div>
                    @if($diarioPorSentimento->isEmpty())
                        <div class="dash-empty">Nenhuma entrada de diário cadastrada ainda.</div>
                    @else
                        <div id="chart-diario-sentimento" class="dash-chart"></div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{--
        A partir daqui, dentro do <script>, NÃO usamos diretivas de controle
        do Blade (@if, @foreach, @endif...). Usamos só @json(), que injeta
        um valor — isso evita o falso positivo "Decorators are not valid
        here" que o VS Code mostra quando confunde "@if"/"@endif" soltos com
        decorators de JS/TS. A checagem "tem dado ou não" agora é feita em
        JavaScript puro (if (!el) return; / if (dados.length === 0) return;).
    --}}
    <script>
        // Paleta Focus+ para os gráficos
        const focusPalette = ['#2563EB', '#3B82F6', '#60A5FA', '#8B5CF6', '#22C55E', '#F59E0B', '#EF4444', '#A78BFA'];
        const mutedTextStyle = { color: '#5A6B8A', fontFamily: 'Outfit, sans-serif', fontSize: 12 };

        // ───────────────────────────────
        // 1) PIZZA — Tarefas por Tipo
        // ───────────────────────────────
        (function () {
            const el = document.getElementById('chart-tarefas-tipo');
            if (!el) return;

            const dados = @json($tarefasPorTipo->map(fn($t) => ['name' => $t->tipo_tarefa, 'value' => $t->total]));
            if (dados.length === 0) return;

            const chart = echarts.init(el);
            chart.setOption({
                color: focusPalette,
                tooltip: { trigger: 'item' },
                legend: { bottom: 0, textStyle: mutedTextStyle },
                series: [{
                    name: 'Tarefas',
                    type: 'pie',
                    radius: '62%',
                    center: ['50%', '45%'],
                    data: dados,
                    label: { color: '#E8EDF5' },
                    itemStyle: { borderColor: '#0E1525', borderWidth: 2 },
                    emphasis: { itemStyle: { shadowBlur: 14, shadowColor: 'rgba(59,130,246,0.4)' } }
                }]
            });
            window.addEventListener('resize', () => chart.resize());
        })();

        // ───────────────────────────────
        // 2) BARRAS — Hobbies por Categoria
        // ───────────────────────────────
        (function () {
            const el = document.getElementById('chart-hobbies-categoria');
            if (!el) return;

            const categorias = @json($hobbiesPorCategoria->pluck('categoria'));
            const totais = @json($hobbiesPorCategoria->pluck('total'));
            if (categorias.length === 0) return;

            const chart = echarts.init(el);
            chart.setOption({
                color: focusPalette,
                tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
                grid: { left: '3%', right: '4%', bottom: '8%', containLabel: true },
                xAxis: {
                    type: 'category',
                    data: categorias,
                    axisLine: { lineStyle: { color: '#1A2B4A' } },
                    axisLabel: mutedTextStyle
                },
                yAxis: {
                    type: 'value',
                    splitLine: { lineStyle: { color: '#14203A' } },
                    axisLabel: mutedTextStyle
                },
                series: [{
                    name: 'Hobbies',
                    type: 'bar',
                    data: totais,
                    barWidth: '46%',
                    itemStyle: { color: '#3B82F6', borderRadius: [6, 6, 0, 0] },
                    emphasis: { itemStyle: { color: '#60A5FA' } }
                }]
            });
            window.addEventListener('resize', () => chart.resize());
        })();

        // ───────────────────────────────
        // 3) LINHA — Tarefas criadas por data
        // ───────────────────────────────
        (function () {
            const el = document.getElementById('chart-tarefas-data');
            if (!el) return;

            const datas = @json($tarefasPorData->pluck('data_inicio'));
            const totais = @json($tarefasPorData->pluck('total'));
            if (datas.length === 0) return;

            const chart = echarts.init(el);
            chart.setOption({
                tooltip: { trigger: 'axis' },
                grid: { left: '3%', right: '4%', bottom: '8%', containLabel: true },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: datas,
                    axisLine: { lineStyle: { color: '#1A2B4A' } },
                    axisLabel: mutedTextStyle
                },
                yAxis: {
                    type: 'value',
                    splitLine: { lineStyle: { color: '#14203A' } },
                    axisLabel: mutedTextStyle
                },
                series: [{
                    name: 'Tarefas criadas',
                    type: 'line',
                    smooth: true,
                    data: totais,
                    showSymbol: true,
                    symbolSize: 7,
                    lineStyle: { color: '#3B82F6', width: 3 },
                    itemStyle: { color: '#60A5FA' },
                    areaStyle: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                            { offset: 0, color: 'rgba(59,130,246,0.35)' },
                            { offset: 1, color: 'rgba(59,130,246,0)' }
                        ])
                    }
                }]
            });
            window.addEventListener('resize', () => chart.resize());
        })();

        // ───────────────────────────────
        // 4) ROSCA (DONUT) — Diário por Sentimento
        // ───────────────────────────────
        (function () {
            const el = document.getElementById('chart-diario-sentimento');
            if (!el) return;

            const dados = @json($diarioPorSentimento->map(fn($d) => ['name' => $d->feeling_diary, 'value' => $d->total]));
            if (dados.length === 0) return;

            const chart = echarts.init(el);
            chart.setOption({
                color: focusPalette,
                tooltip: { trigger: 'item' },
                legend: { bottom: 0, textStyle: mutedTextStyle },
                series: [{
                    name: 'Diário',
                    type: 'pie',
                    radius: ['38%', '65%'],
                    center: ['50%', '45%'],
                    avoidLabelOverlap: true,
                    itemStyle: { borderColor: '#0E1525', borderWidth: 2 },
                    label: { color: '#E8EDF5' },
                    data: dados,
                    emphasis: { itemStyle: { shadowBlur: 14, shadowColor: 'rgba(59,130,246,0.4)' } }
                }]
            });
            window.addEventListener('resize', () => chart.resize());
        })();
    </script>
</body>
</html>
