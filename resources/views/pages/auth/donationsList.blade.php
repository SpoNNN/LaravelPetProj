@extends('layouts.blank')

@section('title', 'DonationPetProject')

@section('content')
    <div class="row main__inner">
        @include('layouts.app.sidebar')
        <div class="col-9 p-4 p-md-5 mb-4 text-body-emphasis bg-dark ">
            <div class="container text-white">
                <div class="px-0">
                    <p>Баланс: {{ $balance->balance }} Р</p>



                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Имя</th>
                                <th scope="col">Сообщение</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Дата</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($donateList as $List)
                                <tr>
                                    <td class="col-1">{{ $List->id }}</td>
                                    <td class="col-2">{{ $List->donator_name }}</td>
                                    <td class="col-5">{{ $List->message }}</td>
                                    <td class="col-2">{{ $List->amount }} Р</td>
                                    <td class="col-3">{{ $List->updated_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="how_section">

    </div>

@endsection
