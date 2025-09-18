<div class="container ">
    <footer class="py-3 my-4 ">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{route('home.index')}}" class="nav-link px-2 text-body-secondary">Главная</a></li>

            <li class="nav-item"><a href="{{route('about')}}" class="nav-link px-2 text-body-secondary">О нас</a></li>
            @if (Auth::user())
                <li class="nav-item"><a href="{{route('profile.index')}}" class="nav-link px-2 text-body-secondary">Профиль</a></li>
            @endif
        </ul>
        <p class="text-center text-body-secondary">© 2025 ООО "Рога и копыта", Inc</p>
    </footer>
</div>
