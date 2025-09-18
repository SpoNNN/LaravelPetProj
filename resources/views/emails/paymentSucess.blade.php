<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Спасибо за донат!</title>
</head>

<body>
    <h1>Привет, {{ $donation->donator_name }}!</h1>
    <p>Спасибо за вашу поддержку! </p>
    <p>На сумму: {{ $donation->amount }} ₽</p>
    <p>Статус пожертвования: Оплата прошла успешно</p>
</body>

</html>
