@extends('layouts.blank')

@section('title', 'DonationPetProject')

@section('content')
    <div class="row main__inner">
        @include('layouts.app.sidebar')
        <div class="col-9 p-4 p-md-5 mb-4 text-body-emphasis bg-dark ">
            <p>Ваш баланс: {{ $balance->balance }}</p>
            <button class="btn btn-success">Вывести</button>
        </div>
        <div class="how_section">

        </div>

    @endsection
