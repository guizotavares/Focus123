<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus+ | Minha Conta</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{url('css/conta-edit.css')}}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
    <style>
        :root {
            --body-color:  #FFF5F8;
            --pink:        #e84393;
            --pink-mid:    #FF6B9D;
            --pink-light:  #FF9AB8;
            --pink-pale:   #FFF0F6;
            --text:        #2D1B35;
            --text-muted:  #9B8FA8;
            --border:      rgba(232, 67, 147, 0.14);
            --white:       #ffffff;
        }

        * { font-family: 'DM Sans', sans-serif; margin: 0; padding: 0; box-sizing: border-box; text-decoration: none; }
        body { background: var(--body-color); }

        /* ── Layout base ── */
        .home {
            position: relative;
            left: 250px;
            width: calc(100% - 250px);
            background: var(--body-color);
            min-height: 100vh;
        }
        .sidebar.close ~ .home {
            left: 88px;
            width: calc(100% - 88px);
        }

        /* ── Header ── */
        .header-home {
            background: #fff;
            padding: 0 48px;
            height: 68px;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 0 var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .logo {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
        }

        .logo span {
            color: var(--pink);
        }

        /* ── Corpo ── */
        .page-body { padding: 40px 48px; display: grid; grid-template-columns: 280px 1fr; gap: 28px; }

        /* ── Painel esquerdo (perfil estático) ── */
        .profile-panel { display: flex; flex-direction: column; gap: 16px; }

        .profile-card {
            background: #fff; border: 1.5px solid var(--border); border-radius: 20px;
            padding: 28px 22px;
            display: flex; flex-direction: column; align-items: center; text-align: center;
        }

        .avatar-wrap { position: relative; margin-bottom: 16px; }

        .avatar {
            width: 90px; height: 90px; border-radius: 50%;
            background: linear-gradient(135deg, var(--pink-mid), var(--pink));
            display: flex; align-items: center; justify-content: center;
            font-size: 2.4rem; color: #fff; font-weight: 700;
            box-shadow: 0 6px 20px rgba(232,67,147,0.3);
        }

        .avatar-badge {
            position: absolute; bottom: 2px; right: 2px;
            width: 26px; height: 26px; border-radius: 50%;
            background: var(--pink); border: 3px solid #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; color: #fff;
        }

        .profile-name  { font-size: 1.1rem; font-weight: 700; color: var(--text); margin-bottom: 4px; }
        .profile-email { font-size: 0.78rem; color: var(--text-muted); word-break: break-all; }

        .profile-since {
            margin-top: 16px; padding-top: 16px;
            border-top: 1px solid var(--border); width: 100%;
            font-size: 0.75rem; color: var(--text-muted);
        }

        .info-chip {
            background: #fff; border: 1.5px solid var(--border); border-radius: 14px;
            padding: 14px 18px; display: flex; align-items: center; gap: 12px;
        }

        .info-chip-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--pink-pale);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: var(--pink); flex-shrink: 0;
        }

        .info-chip-label { font-size: 0.7rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; }
        .info-chip-value { font-size: 0.84rem; font-weight: 600; color: var(--text); margin-top: 1px; }

        /* ── Painel direito (formulário) ── */
        .form-panel { display: flex; flex-direction: column; gap: 20px; }

        .form-section {
            background: #fff; border: 1.5px solid var(--border);
            border-radius: 20px; overflow: hidden;
        }

        .section-head {
            padding: 18px 24px; display: flex; align-items: center; gap: 10px;
            border-bottom: 1px solid var(--border); background: #FDFAFD;
        }

        .section-head-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: linear-gradient(135deg, var(--pink-mid), var(--pink));
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; color: #fff;
        }

        .section-head h2 { font-size: 0.9rem; font-weight: 700; color: var(--text); }
        .section-head p  { font-size: 0.75rem; color: var(--text-muted); margin-top: 1px; }

        .section-body { padding: 22px 24px; display: flex; flex-direction: column; gap: 18px; }

        /* ── Campos ── */
        .field-row      { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field-row.full { grid-template-columns: 1fr; }
        .field-group    { display: flex; flex-direction: column; gap: 6px; }

        .field-label {
            display: flex; align-items: center; gap: 5px;
            font-size: 0.7rem; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.9px;
        }
        .field-label i { font-size: 13px; color: var(--pink-light); }

        .input-wrap { position: relative; display: flex; align-items: center; }

        .field-input {
            width: 100%; padding: 11px 16px;
            border: 1.5px solid #EEE3F0; border-radius: 12px;
            font-size: 0.88rem; color: var(--text); background: #FDFAFD;
            outline: none; transition: 0.2s; font-family: 'DM Sans', sans-serif;
        }
        .field-input:focus { border-color: var(--pink-light); background: #fff; box-shadow: 0 0 0 3px rgba(255,154,184,0.12); }
        .field-input::placeholder { color: #C8BAD0; }
        .field-input.has-eye { padding-right: 44px; }

        .eye-btn {
            position: absolute; right: 12px;
            background: none; border: none; cursor: pointer;
            color: #C8BAD0; font-size: 17px; display: flex; align-items: center;
            transition: color 0.2s; padding: 0;
        }
        .eye-btn:hover { color: var(--pink); }

        /* ── Senhas – botões ── */
        .btn-change-password {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 24px;
            background: #fff; border: 1.5px solid var(--pink-light);
            border-radius: 12px; color: var(--pink);
            font-size: 0.9rem; font-weight: 600;
            cursor: pointer; transition: 0.2s;
        }
        .btn-change-password:hover { background: var(--pink); color: #fff; border-color: var(--pink); }

        .btn-cancel-pwd {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px;
            background: transparent; border: 1.5px solid var(--border);
            border-radius: 10px; color: var(--text-muted);
            font-size: 0.82rem; font-weight: 600;
            cursor: pointer; transition: 0.2s; font-family: 'DM Sans', sans-serif;
        }
        .btn-cancel-pwd:hover { border-color: var(--pink-light); color: var(--pink); background: var(--pink-pale); }

        .hint-text { font-size: 0.75rem; color: var(--text-muted); margin-top: 8px; }

        /* ── Alertas ── */
        .alert {
            padding: 12px 16px; border-radius: 12px; font-size: 0.82rem;
            display: flex; align-items: center; gap: 8px;
        }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-error   { background: #fee2e2; color: #991b1b; }

        /* ── Barra de ações (salvar/cancelar) ── */
        .action-bar {
            display: flex; align-items: center; justify-content: flex-end; gap: 12px;
            padding: 20px 24px;
            background: #FDFAFD; border-top: 1px solid var(--border);
        }

        .btn-cancel {
            display: flex; align-items: center; gap: 7px;
            padding: 12px 24px;
            border: 1.5px solid var(--border); border-radius: 12px;
            background: transparent; color: var(--text-muted);
            font-size: 0.88rem; font-weight: 600;
            cursor: pointer; transition: 0.2s; font-family: 'DM Sans', sans-serif;
        }
        .btn-cancel:hover { border-color: var(--pink-light); color: var(--pink); background: var(--pink-pale); }

        .btn-save {
            display: flex; align-items: center; gap: 8px;
            padding: 13px 36px;
            background: linear-gradient(135deg, var(--pink-mid), var(--pink));
            border: none; border-radius: 14px;
            color: #fff; font-size: 0.95rem; font-weight: 700;
            cursor: pointer; transition: 0.25s; font-family: 'DM Sans', sans-serif;
            box-shadow: 0 6px 20px rgba(232,67,147,0.32);
        }
        .btn-save:hover  { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(232,67,147,0.44); }
        .btn-save:active { transform: scale(0.98); }

        .confirm-msg { font-size: 0.72rem; font-weight: 500; margin-top: 4px; }
    </style>
</head>
<body>
    @include('components/sidebar')

    <section class="home">

        <div class="header-home">
            <a href="./index.html" class="logo">Focus<span>+</span></a>
        </div>

        <!-- Corpo da página -->
        <div class="page-body">

            <!-- Painel esquerdo: resumo do perfil -->
            <div class="profile-panel">
                <div class="profile-card">
                    <div class="avatar-wrap">
                        <div class="avatar">
                            {{ strtoupper(substr($usuario->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="avatar-badge"><i class="bx bx-pencil"></i></div>
                    </div>
                    <div class="profile-name">{{ $usuario->name ?? '—' }}</div>
                    <div class="profile-email">{{ $usuario->email ?? '—' }}</div>
                    <div class="profile-since">
                        <i class="bx bx-time-five"></i>
                        Membro desde {{ $usuario->created_at ? $usuario->created_at->format('M/Y') : '—' }}
                    </div>
                </div>

                <div class="info-chip">
                    <div class="info-chip-icon"><i class="bx bx-user-id-card"></i></div>
                    <div>
                        <div class="info-chip-label">CPF</div>
                        <div class="info-chip-value">{{ $usuario->cpf ?? '—' }}</div>
                    </div>
                </div>

                <div class="info-chip">
                    <div class="info-chip-icon"><i class="bx bx-phone"></i></div>
                    <div>
                        <div class="info-chip-label">Telefone</div>
                        <div class="info-chip-value">{{ $usuario->telefone ?? '—' }}</div>
                    </div>
                </div>

                <div class="info-chip">
                    <div class="info-chip-icon"><i class="bx bx-birthday-cake"></i></div>
                    <div>
                        <div class="info-chip-label">Nascimento</div>
                        <div class="info-chip-value">
                            {{ $usuario->data_nasc ? \Carbon\Carbon::parse($usuario->data_nasc)->format('d/m/Y') : '—' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Painel direito: formulário -->
            <div class="form-panel">

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bx bx-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <i class="bx bx-error-circle"></i> {{ $errors->first() }}
                    </div>
                @endif

                {{-- =============================================
                     FORMULÁRIO PRINCIPAL
                     O botão "Salvar alterações" está no final,
                     dentro do form — sempre visível.
                =============================================== --}}
                <form action="{{ route('conta.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Seção: Informações Pessoais -->
                    <div class="form-section">
                        <div class="section-head">
                            <div class="section-head-icon"><i class="bx bx-user"></i></div>
                            <div>
                                <h2>Informações Pessoais</h2>
                                <p>Atualize seus dados de perfil</p>
                            </div>
                        </div>
                        <div class="section-body">
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label"><i class="bx bx-user"></i> Nome</label>
                                    <input type="text" name="name" class="field-input"
                                           value="{{ old('name', $usuario->name) }}"
                                           placeholder="Seu nome completo">
                                </div>
                                <div class="field-group">
                                    <label class="field-label"><i class="bx bx-envelope"></i> E-mail</label>
                                    <input type="email" name="email" class="field-input"
                                           value="{{ old('email', $usuario->email) }}"
                                           placeholder="seu@email.com">
                                </div>
                            </div>
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label"><i class="bx bx-phone"></i> Telefone</label>
                                    <input type="tel" name="telefone" class="field-input"
                                           value="{{ old('telefone', $usuario->telefone) }}"
                                           placeholder="(11) 99999-9999">
                                </div>
                                <div class="field-group">
                                    <label class="field-label"><i class="bx bx-calendar-alt"></i> Data de Nascimento</label>
                                    <input type="date" name="data_nasc" class="field-input"
                                           value="{{ old('data_nasc', optional($usuario->data_nasc)->format('Y-m-d')) }}">
                                </div>
                            </div>
                            <div class="field-row full">
                                <div class="field-group">
                                    <label class="field-label"><i class="bx bx-user-id-card"></i> CPF</label>
                                    <input type="text" name="cpf" class="field-input"
                                           value="{{ old('cpf', $usuario->cpf) }}"
                                           placeholder="000.000.000-00">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seção: Segurança (alterar senha) -->
                    <div class="form-section" style="margin-top: 20px;">
                        <div class="section-head">
                            <div class="section-head-icon"><i class="bx bx-lock"></i></div>
                            <div>
                                <h2>Segurança</h2>
                                <p>Gerencie sua senha de acesso</p>
                            </div>
                        </div>
                        <div class="section-body">

                            {{-- Botão que revela os campos de senha --}}
                            <div id="showPasswordBtnWrapper">
                                <button type="button" class="btn-change-password" id="showPasswordBtn">
                                    <i class="bx bx-key"></i> Alterar senha
                                </button>
                                <p class="hint-text">Você precisará informar sua senha atual.</p>
                            </div>

                            {{-- Campos de senha (ocultos inicialmente) --}}
                            <div id="passwordFields" style="display: none;">
                                <div class="field-row full" style="margin-bottom: 16px;">
                                    <div class="field-group">
                                        <label class="field-label"><i class="bx bx-lock-open-alt"></i> Senha Atual</label>
                                        <div class="input-wrap">
                                            <input type="password" name="current_password" id="currentPwd"
                                                   class="field-input has-eye"
                                                   placeholder="Digite sua senha atual">
                                            <button type="button" class="eye-btn" onclick="toggleEye('currentPwd', this)">
                                                <i class="bx bx-hide"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="field-row">
                                    <div class="field-group">
                                        <label class="field-label"><i class="bx bx-lock"></i> Nova Senha</label>
                                        <div class="input-wrap">
                                            <input type="password" name="password" id="pwdInput"
                                                   class="field-input has-eye"
                                                   placeholder="Mínimo 6 caracteres">
                                            <button type="button" class="eye-btn" onclick="toggleEye('pwdInput', this)">
                                                <i class="bx bx-hide"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label"><i class="bx bx-lock-open-alt"></i> Confirmar Nova Senha</label>
                                        <div class="input-wrap">
                                            <input type="password" name="password_confirmation" id="pwdConfirm"
                                                   class="field-input has-eye"
                                                   placeholder="Repita a nova senha"
                                                   oninput="checkMatch()">
                                            <button type="button" class="eye-btn" onclick="toggleEye('pwdConfirm', this)">
                                                <i class="bx bx-hide"></i>
                                            </button>
                                        </div>
                                        <p class="confirm-msg" id="confirmMsg"></p>
                                    </div>
                                </div>
                                <div style="margin-top: 12px;">
                                    <button type="button" class="btn-cancel-pwd" id="cancelPasswordBtn">
                                        <i class="bx bx-x"></i> Cancelar alteração de senha
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Barra de ações: sempre visível no final do form -->
                    <div class="action-bar" style="border-radius: 0 0 20px 20px; margin-top: 20px; background: #fff; border: 1.5px solid var(--border); border-radius: 20px;">
                        <a href="{{ route('conta.show') }}" class="btn-cancel">
                            <i class="bx bx-x"></i> Cancelar
                        </a>
                        <button type="submit" class="btn-save">
                            <i class="bx bx-save"></i> Salvar alterações
                        </button>
                    </div>

                </form>
                {{-- Fim do formulário --}}

            </div>
            {{-- Fim do form-panel --}}

        </div>
        {{-- Fim do page-body --}}

    </section>

    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Mostra/oculta a senha (ícone de olho)
        function toggleEye(id, btn) {
            const el = document.getElementById(id);
            const ic = btn.querySelector('i');
            el.type = el.type === 'password' ? 'text' : 'password';
            ic.className = el.type === 'password' ? 'bx bx-hide' : 'bx bx-show';
        }

        // Verifica se as senhas coincidem
        function checkMatch() {
            const p = document.getElementById('pwdInput').value;
            const c = document.getElementById('pwdConfirm').value;
            const m = document.getElementById('confirmMsg');
            if (!c) { m.textContent = ''; return; }
            m.textContent = p === c ? '✓ Senhas coincidem' : '✗ As senhas não coincidem';
            m.style.color = p === c ? '#16a34a' : '#ef4444';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const showBtn   = document.getElementById('showPasswordBtn');
            const wrapper   = document.getElementById('showPasswordBtnWrapper');
            const fields    = document.getElementById('passwordFields');
            const cancelBtn = document.getElementById('cancelPasswordBtn');

            // Abre os campos de senha
            showBtn.addEventListener('click', function () {
                wrapper.style.display = 'none';
                fields.style.display  = 'block';
            });

            // Fecha e limpa os campos de senha
            cancelBtn.addEventListener('click', function () {
                document.getElementById('currentPwd').value  = '';
                document.getElementById('pwdInput').value    = '';
                document.getElementById('pwdConfirm').value  = '';
                document.getElementById('confirmMsg').textContent = '';
                fields.style.display  = 'none';
                wrapper.style.display = 'block';
            });
        });
    </script>
</body>
</html>
