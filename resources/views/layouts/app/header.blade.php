<header class="p-3 bg-black">

    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"> <a href="/"
            class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"> <svg class="bi me-2"
                width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg> </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white">Тут логотип</a></li>

        </ul>

        <div class="text-end">
            @if (Auth::check())
                <a href="{{ route('profile.index') }}" class="btn btn-outline-light me-2">Профиль</a>
                <a href="{{ route('logout') }}" class="btn btn-outline-light me-2">Выход</a>
            @else
                <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal"
                    class="btn btn-outline-light me-2">Авторизация</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#registerModal"
                    class="btn btn-outline-warning">Регистрация</button>
            @endif
        </div>
    </div>

</header>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="loginForm" action="{{ route('login') }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Авторизация</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-grid gap-3">
                    <label for="email">Введите почту</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Почта">
                 
                    <label for="password">Введите пароль</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Пароль">
                    
                    <!-- Общий блок для ошибок авторизации -->
                    <div class="invalid-feedback d-none" id="emailpasswordError"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary text-white"
                        data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Войти</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="registerForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registerModalLabel">Регистрация</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-grid gap-3">
                    <div>
                        <label for="login">Введите логин</label>
                        <input name="login" type="text" class="form-control" id="login" placeholder="Логин">
                        <div class="invalid-feedback" id="loginError"></div>
                    </div>

                    <div>
                        <label for="email">Введите почту</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Почта">
                        <div class="invalid-feedback" id="emailError"></div>
                    </div>

                    <div>
                        <label for="password">Введите пароль</label>
                        <input name="password" type="password" class="form-control" id="password"
                            placeholder="Пароль">
                        <div class="invalid-feedback" id="passwordError"></div>
                    </div>

                    <div>
                        <label for="passwordVerify">Введите пароль снова</label>
                        <input name="password_verify" type="password" class="form-control" id="passwordVerify"
                            placeholder="Подтверждение пароля">
                        <div class="invalid-feedback" id="password_verifyError"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>
