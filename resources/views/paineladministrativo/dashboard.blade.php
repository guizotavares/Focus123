<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
    <style>
        :root {
            --bg: #090D18;
            --surface: #0E1525;
            --surface-2: #14203A;
            --blue: #2563EB;
            --blue-mid: #3B82F6;
            --blue-light: #60A5FA;
            --text: #E8EDF5;
            --text-muted: #5A6B8A;
            --border: rgba(59, 130, 246, 0.14);
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit', sans-serif; }
        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
        }
        header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 48px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo-tag {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .logo-tag span { color: var(--blue-mid); }
        header a {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            transition: 0.2s;
        }
        header a:hover {
            border-color: rgba(239,68,68,0.35);
            color: #F87171;
            background: rgba(239,68,68,0.08);
        }
        main {
            padding: 60px 48px;
        }
        main h1 {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        main p.sub {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 32px;
        }
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            max-width: 480px;
        }
        .card p {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.7;
        }
        .card p strong { color: var(--text); }
    </style>
</head>
<body>
    <header>
        <div class="logo-tag">Focus<span>.</span></div>
        <a href="/logout"><i class="bx bx-log-out"></i> Sair</a>
    </header>

    <section>
        <h1>Dashboard</h1>
    </section>

    <main>
        <p class="sub">Área autenticada — protegida pelo middleware Authenticate.</p>
        <div class="card">
            <p>
                Você está logado como <strong>{{ auth()->user()->name ?? 'Usuário' }}</strong>,
                usando o e-mail <strong>{{ auth()->user()->email ?? '—' }}</strong>.
            </p>
        </div>
    </main>
</body>
</html>
