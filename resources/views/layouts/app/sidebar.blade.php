<div class="p-3 bg-body-tertiary" style="width: 18rem; height: 40rem; ">
   
        <svg class="bi pe-none" width="40" height="32" aria-hidden="true">
            <use xlink:href="#bootstrap"></use>
        </svg> <span class="fs-4">{{ Auth::user()->login }}</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        @if (request()->is('profile'))
            <li class="nav-item"> <a href="{{ route('profile.index') }}" class="nav-link active  link-body-emphasis"
                    aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                    </svg>
                    Главная
                </a> </li>
        @else
            <li class="nav-item"> <a href="{{ route('profile.index') }}" class="nav-link link-body-emphasis"
                    aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                    </svg>
                    Главная
                </a> </li>
        @endif

        @if (request()->is('donations'))
            <li> <a href="{{ route('donations.index') }}" class="nav-link active link-body-emphasis"> <svg
                        class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                    </svg>
                    Список пожертвований
                </a> </li>
        @else
            <li> <a href="{{ route('donations.index') }}" class="nav-link link-body-emphasis"> <svg
                        class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                    </svg>
                    Список пожертвований
                </a> </li>
        @endif

        @if (request()->is('withdraw'))
            <li> <a href="#" class="nav-link active link-body-emphasis"> <svg class="bi pe-none me-2"
                        width="16" height="16" aria-hidden="true">
                    </svg>
                    Вывод
                </a> </li>
        @else
            <li> <a href="#" class="nav-link link-body-emphasis"> <svg class="bi pe-none me-2" width="16"
                        height="16" aria-hidden="true">
                    </svg>
                    Вывод
                </a> </li>
        @endif

    </ul>


</div>
