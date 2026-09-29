<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus+ | Entrar</title>
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    <link rel="icon" type="image/png" href="{{url('./images/icon.png')}}">
    <style>

    </style>
</head>
<body>

{{-- ─────────── Lado esquerdo ─────────── --}}
<div class="split-left">
    <div class="left-blob"></div>
    <div class="left-content">
        <img src="{{url('./images/icon.png')}}" alt="Mali+" class="left-logo"?>

        <div class="left-brand">Crie sua conta no Focus<span>+</span></div>
        <p class="left-tagline">Seu espaço de organização pessoal</p>

        <div class="left-features">
            <div class="feature-item">
                <div class="feature-icon"><i class="bx bx-task"></i></div>
                <div class="feature-text">
                    <strong>Gestão de Tarefas</strong>
                    <span>Organize seu dia com facilidade</span>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="bx bx-book-bookmark"></i></div>
                <div class="feature-text">
                    <strong>Diário Pessoal</strong>
                    <span>Registre seus pensamentos</span>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="bx bx-calendar-alt"></i></div>
                <div class="feature-text">
                    <strong>Agenda</strong>
                    <span>Nunca perca um compromisso</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ─────────── Lado direito (formulário) ─────────── --}}
<div class="split-right">

    <div class="form-header">
        <p class="form-greeting" id="formGreeting">Bem-vindo de volta</p>
        <h1 class="form-title" id="formTitle">Entre na sua conta</h1>
        <p class="form-subtitle" id="formSubtitle">Insira seus dados para continuar</p>
    </div>

    {{-- Abas --}}
    <div class="tabsWrapper">
        <button id="loginTab"    class="tabButton activeTab">Login</button>
        <button id="registerTab" class="tabButton">Cadastro</button>
    </div>

    {{-- Alertas de sessão --}}
    @if(session('sucesso'))
        <div class="alert alert-success">
            <i class="bx bx-check-circle"></i> {{ session('sucesso') }}
        </div>
    @endif

    @if(session('erro'))
        <div class="alert alert-error">
            <i class="bx bx-error-circle"></i> {{ session('erro') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-validation">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário --}}
    <form method="POST" action="/auth" id="authForm">
        @csrf

        {{-- Nome (só no cadastro) --}}
        <div class="fieldGroup hidden" id="nameField">
            <label class="label"><i class="bx bx-user"></i> Nome completo</label>
            <div class="input-wrapper">
                <input type="text" name="name" class="input"
                       placeholder="Seu nome completo"
                       value="{{ old('name') }}">
            </div>
        </div>

        {{-- E-mail --}}
        <div class="fieldGroup">
            <label class="label"><i class="bx bx-envelope"></i> E-mail</label>
            <div class="input-wrapper">
                <input type="email" name="email" class="input"
                       placeholder="seu@email.com"
                       value="{{ old('email') }}">
            </div>
        </div>


        {{-- CPF --}}
        <div class="fieldGroup" id="cpfField">
            <label class="label"><i class="bx bx-user-id-card"></i> CPF</label>
            <div class="input-wrapper">
                <input type="text" name="cpf" class="input"
                       placeholder="000.000.000-00"
                       value="{{ old('cpf') }}">
            </div>
        </div>

        {{-- Telefone + Data de Nascimento (só no cadastro, lado a lado) --}}
        <div class="fields-row hidden" id="phoneDateRow">
            <div class="fieldGroup">
                <label class="label"><i class="bx bx-phone"></i> Telefone</label>
                <div class="input-wrapper">
                    <input type="tel" name="phone" class="input"
                           placeholder="(11) 99999-9999"
                           value="{{ old('telefone') }}">
                </div>
            </div>
            <div class="fieldGroup">
                <label class="label"><i class="bx bx-calendar-alt"></i> Nascimento</label>
                <div class="input-wrapper">
                    <input type="date" name="data_nasc" class="input"
                           value="{{ old('data_nasc') }}">
                </div>
            </div>
        </div>

        {{-- Senha --}}
        <div class="fieldGroup">
            <label class="label"><i class="bx bx-lock-alt"></i> Senha</label>
            <div class="input-wrapper">
                <input type="password" name="password" id="passwordInput" class="input has-eye"
                       placeholder="••••••••">
                <button type="button" class="eye-btn" onclick="toggleEye('passwordInput', this)">
                    <i class="bx bx-hide"></i>
                </button>
            </div>
                <span class="password-label" id="passwordLabel">Digite sua senha</span>

        </div>

        {{-- Confirmar senha (só no cadastro) --}}
        <div class="fieldGroup hidden" id="confirmField">
            <label class="label"><i class="bx bx-lock-open-alt"></i> Confirmar senha</label>
            <div class="input-wrapper">
                <input type="password" name="password_confirmation" id="confirmInput"
                       class="input has-eye"
                       placeholder="••••••••"
                       oninput="checkConfirm()">
                <button type="button" class="eye-btn" onclick="toggleEye('confirmInput', this)">
                    <i class="bx bx-hide"></i>
                </button>
            </div>
            <p id="confirmMsg" style="font-size:0.72rem;margin-top:5px;display:none;"></p>
        </div>

        <button type="submit" class="button" id="submitBtn">Entrar</button>
    </form>

    <div class="divider">ou continue com</div>

    <div class="socialContainer">
        <button class="socialBtn" type="button">
            <img src="/images/iconGoogle.png" alt="Google">
            Google
        </button>
        <button class="socialBtn" type="button">
            <img src="/images/facebook.png" alt="Facebook">
            Facebook
        </button>
    </div>

</div>

<script>
    // ─── Elementos ───
    const loginTab      = document.getElementById('loginTab')
    const registerTab   = document.getElementById('registerTab')
    const nameField     = document.getElementById('nameField')
    const phoneDateRow  = document.getElementById('phoneDateRow')
    const cpfField      = document.getElementById('cpfField')
    const confirmField  = document.getElementById('confirmField')
    const submitBtn     = document.getElementById('submitBtn')
    const authForm      = document.getElementById('authForm')
    const formTitle     = document.getElementById('formTitle')
    const formSubtitle  = document.getElementById('formSubtitle')
    const formGreeting  = document.getElementById('formGreeting')

    const hadNameField  = {{ old('name') ? 'true' : 'false' }}
    let isLogin = !hadNameField

    function showEl(el)  { el.classList.remove('hidden') }
    function hideEl(el)  { el.classList.add('hidden') }

    function updateUI() {
        if (isLogin) {
            hideEl(nameField); hideEl(phoneDateRow); hideEl(confirmField); hideEl(cpfField);
            nameField.querySelector('input').removeAttribute('required')
            loginTab.classList.add('activeTab')
            registerTab.classList.remove('activeTab')
            submitBtn.textContent   = 'Entrar na conta'
            formGreeting.textContent = 'Bem-vindo de volta'
            formTitle.textContent    = 'Entre na sua conta'
            formSubtitle.textContent = 'Insira seus dados para continuar'
            authForm.action          = '/login'
            document.getElementById('passwordLabel').textContent = 'Digite sua senha'
        } else {
            showEl(nameField); showEl(phoneDateRow); showEl(confirmField) ; showEl(cpfField);
            nameField.querySelector('input').setAttribute('required', 'required')
            registerTab.classList.add('activeTab')
            loginTab.classList.remove('activeTab')
            submitBtn.textContent    = 'Criar minha conta'
            formGreeting.textContent = 'Primeira vez aqui?'
            formTitle.textContent    = 'Crie sua conta'
            formSubtitle.textContent = 'Preencha os dados abaixo para começar'
            authForm.action          = '/auth'
        }
    }

    loginTab.onclick    = () => { isLogin = true;  updateUI() }
    registerTab.onclick = () => { isLogin = false; updateUI() }
    updateUI()

    // ─── Toggle olhinho ───
    function toggleEye(inputId, btn) {
        const input = document.getElementById(inputId)
        const icon  = btn.querySelector('i')
        if (input.type === 'password') {
            input.type = 'text'
            icon.className = 'bx bx-show'
        } else {
            input.type = 'password'
            icon.className = 'bx bx-hide'
        }
    }

    // ─── Confirmar senha ───
    function checkConfirm() {
        if (isLogin) return
        const pwd     = document.getElementById('passwordInput').value
        const confirm = document.getElementById('confirmInput').value
        const msg     = document.getElementById('confirmMsg')
        if (!confirm) { msg.style.display = 'none'; return }
        msg.style.display = 'block'
        if (pwd === confirm) {
            msg.textContent  = '✓ Senhas coincidem'
            msg.style.color  = '#16a34a'
        } else {
            msg.textContent  = '✗ As senhas não coincidem'
            msg.style.color  = '#ef4444'
        }
    }
</script>

</body>
</html>
