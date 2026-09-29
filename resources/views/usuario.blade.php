<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus | Criar Usuário</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        section {
            width: 100%;
            max-width: 440px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px 36px;
        }
        h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--text);
            text-align: center;
            margin-bottom: 28px;
            letter-spacing: 0.5px;
        }
        div.field { margin-bottom: 18px; }
        label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--surface-2);
            background: var(--surface-2);
            border-radius: 10px;
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }
        input:focus {
            border-color: var(--blue-mid);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }
        input[type="submit"] {
            width: 100%;
            margin-top: 8px;
            padding: 13px;
            background: var(--blue);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 4px 18px rgba(59,130,246,0.3);
            transition: 0.2s;
        }
        input[type="submit"]:hover {
            background: var(--blue-mid);
            transform: translateY(-1px);
        }
        .voltar {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--blue-light);
            font-size: 13px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <section>
        <div>
            <h1>Criar Usuário</h1>
        </div>

        <div>
            <form action="usuario-criar" method="post">
                @csrf
                <div class="field">
                    <label for="">Nome</label>
                    <input type="text" name="txNome" placeholder="Seu nome completo" required>
                </div>

                <div class="field">
                    <label for="">E-mail</label>
                    <input type="text" name="txEmail" placeholder="seu@email.com" required>
                </div>

                <div class="field">
                    <label for="">Senha</label>
                    <input type="password" name="txSenha" placeholder="••••••••" required>
                </div>

                <div class="field">
                    <input type="submit" value="Criar">
                </div>
            </form>
            <a href="/login" class="voltar">Já tem conta? Fazer login</a>
        </div>
    </section>
</body>
</html>
