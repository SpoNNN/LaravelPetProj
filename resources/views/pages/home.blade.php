@extends('layouts.blank')

@section('title', 'DonationPetProject')

@section('content')


    <div class="main__inner">
        <div class="p-4 p-md-5 mb-4 text-body-emphasis bg-dark">
            <div class="container text-white">
                <div class="col-lg-6 px-0">
                    <h1 class="display-5 fw-bold ">Крутая система донатов</h1>
                    <p class="lead my-3 ">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis earum ab iure
                        pariatur
                        incidunt laborum cumque odit odio beatae veniam alias rerum non minus, reiciendis voluptates
                        doloremque
                        atque vitae corrupti! </p>
                    <div class="d-grid gap-2 col-3 ">
                        @if (!Auth::check())
                            <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#loginModal"
                                type="button">Начать</button>
                        @endif

                    </div>


                </div>
            </div>
        </div>

    </div>
    <div class="how_section row">
        @foreach ($donate_card as $card)
            <div class="card m-3" style="width: 18rem;">
                <div class="card-title">
                    @if (is_null($card->image))
                        <img src="{{ asset('images/not_found.png') }}" class="card-img-top py-3" style="max-height: 15rem"
                            alt="...">
                    @else
                        <img src="{{ asset('storage') . '/' . $card->image }}" class="card-img-top py-3" alt="...">
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <p class="card-text">{{ $card->name }}</p>
                    <a href="{{ route('donatepage.show', $card->user_id) }}" class="mt-auto">
                        <button class="btn btn-outline-success w-100" type="button">Пожертвовать</button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
