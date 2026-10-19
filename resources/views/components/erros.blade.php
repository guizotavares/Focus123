{{-- Bloco reutilizável de erros de validação.
     Uso: @include('components/erros') logo depois do @csrf do formulário. --}}
@if ($errors->any())
    <div class="alert alert-danger"
         style="background:rgba(239,68,68,.10);border:1px solid rgba(239,68,68,.30);color:#FCA5A5;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
        <ul style="padding-left:18px;line-height:1.7;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif