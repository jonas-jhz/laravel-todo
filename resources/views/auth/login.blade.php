@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<main class="login-wrapper">
    <section class="login-card" aria-labelledby="login-title">
        <header class="login-header">
            <div class="logo-mark" aria-hidden="true"></div>
            <h1 id="login-title">Bem-vindo</h1>
            <p class="subtitle">Acesse sua conta para continuar</p>
        </header>

        <div class="tabs" role="tablist">
            <button class="tab active" data-tab="login" role="tab" aria-selected="true" type="button">Entrar</button>
            <button class="tab" data-tab="register" role="tab" aria-selected="false" type="button">Cadastrar</button>
        </div>

        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- LOGIN -->
        <form id="form-login" class="form active" action="{{ route('login') }}" method="POST" autocomplete="on" novalidate>
            @csrf
            <div class="field">
                <label for="login-email">E-mail</label>
                <input type="email" id="login-email" name="email" placeholder="seu@email.com" value="{{ old('email') }}" required />
            </div>

            <div class="field">
                <label for="login-pass">Senha</label>
                <input type="password" id="login-pass" name="password" placeholder="••••••••" required />
            </div>

            <div class="row-between">
                <label class="checkbox">
                    <input type="checkbox" name="remember" /> <span>Lembrar-me</span>
                </label>
                <a href="#" class="link">Esqueci a senha</a>
            </div>

            <button type="submit" class="btn-primary">Entrar</button>
        </form>

        <!-- REGISTER -->
        <form id="form-register" class="form" action="{{ route('register') }}" method="POST" autocomplete="on" novalidate>
            @csrf
            <div class="field">
                <label for="reg-name">Nome</label>
                <input type="text" id="reg-name" name="name" placeholder="seu nome" value="{{ old('name') }}" required />
            </div>

            <div class="field">
                <label for="reg-email">E-mail</label>
                <input type="email" id="reg-email" name="email" placeholder="voce@email.com" value="{{ old('email') }}" required />
            </div>

            <div class="field">
                <label for="reg-pass">Senha</label>
                <input type="password" id="reg-pass" name="password" placeholder="crie uma senha" required />
            </div>

            <div class="field">
                <label for="reg-pass-conf">Confirmar Senha</label>
                <input type="password" id="reg-pass-conf" name="password_confirmation" placeholder="confirme a senha" required />
            </div>

            <button type="submit" class="btn-primary">Criar conta</button>
        </form>

        <footer class="login-footer">
            <span>&copy; 2026 — Todo App</span>
        </footer>
    </section>
</main>

@vite(['resources/js/auth.js'])
@endsection

