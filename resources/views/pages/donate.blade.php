@extends('layouts.blank')

@section('title', 'DonationPetProject')

@section('content')


    <div class="main__inner">
        <div class="p-4 p-md-5 mb-4 text-body-emphasis bg-dark text-center">
            <div class="container text-white">
                <div class="align-items-center px-0">

                    <h1 class="display-5 fw-bold ">{{ $donate->name }}</h1>
                    <p class="lead my-3 ">{{ $donate->description }}</p>
                    @if (is_null($donate->image))
                        <div class="col">
                            <img style="max-height: 10rem; max-width: 10rem;" src="{{ asset('images/not_found.png') }}"
                                alt="" srcset="">
                        </div>
                    @else
                        <div class="col">
                            <img style="height: 15rem; max-width: 20rem;"
                                src="{{ asset('storage') . '/' . $donate->image }}" alt="" srcset="">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <form action="{{ route('donation.create', $donate->user_id) }}" method="POST">
            @csrf
            <div class="conatainer">
                <div class=" col-6 mx-auto  align-items-center ">
                    <div id="name">
                        <label for="name">Введите имя отправителя</label>
                        <input name="donator_name" type="text" class="form-control" placeholder="Имя отпавителя">
                    </div>
                    <input type="checkbox" class="form-check-input" id="anonymousCheck" name="anonymous" value="1"
                        {{ old('anonymous', $donation->anonymous ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label" for="anonymousCheck">Анонимный донат</label>

                    <br>
                    <label for="message">Введите сообщение</label>
                    <input name="message" type="text" class="form-control" placeholder="Сообщение">

                    <label for="amount">Введите сумуму</label>
                    <input name="amount" type="number" class="form-control" placeholder="Сумма ">
                    <label for="email">Введите почту (не обязательно)</label>
                    <input name="email" type="email" class="form-control" placeholder="Почта для чека ">
                    <br>
                    <button type="submit" class="btn btn btn-success">Отправить</button>
                </div>
            </div>
        </form>
    </div>
    <div class="how_section">

    </div>

@endsection
