@extends('layouts.blank')

@section('title', 'DonationPetProject')

@section('content')
    <div class="row main__inner">
        @include('layouts.app.sidebar')
        <div class="col-9 p-4 p-md-5 mb-4 text-body-emphasis bg-dark ">
            <div class="container text-white">
                <div class="px-0">
                    <h1 class="display-5  fw-bold text-center ">Добро пожаловать, {{ Auth::user()->login }}</h1>

                    <p class="lead my-3 "></p>
                    @if ($profile)
                        @if (!is_null($profile->image))
                            <div class="profile_image__section d-flex justify-content-center ">
                                <img style="height: 20vh; max-width: 30vh"
                                    src="{{ asset('storage') . '/' . $profile->image }}" alt="" srcset="">
                            </div>
                        @endif
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-grid gap-2">
                                <label for="name">Название</label>
                                <input name="name" value=" {{ old('name', $profile->name) }}" class="form-control"
                                    type="text">
                                <label for="description">Описание</label>
                                <input name="description" value="{{ old('description', $profile->description) }}"
                                    type="text" class="form-control" id="description" placeholder="Описание">

                            </div>
                            <label for="image">Выберите фотографию</label>
                            <input name="image" type="file" class="form-control my-2" id="avatar"
                                aria-describedby="avatar" aria-label="Upload">
                            <div class="my-2 d-flex ">
                                <button type="submit" class="btn btn-outline-warning">Изменить</button>
                        </form>
                        <form class="px-4" action="{{ route('profile.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>
                </div>
            @else
                <div class="form__section">
                    <h1 class="text-center">Создайте карточку для пожертвований</h1>
                    <div class="d-grid gap-2">
                        <form action="{{ route('profile.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="name">Введите название</label>
                            <input name="name" type="text" class="form-control my-2" id="email"
                                placeholder="Название">

                            <label for="image">Выберите фотографию</label>
                            <input name="image" type="file" class="form-control my-2" id="avatar"
                                aria-describedby="avatar" aria-label="Upload">

                            <label for="name">Введите описание</label>
                            <input name="description" type="text" class="form-control my-2" id="description"
                                placeholder="Описание">
                            <button type="submit" class="btn btn-outline-success ">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>
    </div>
    <div class="how_section">

    </div>

@endsection
