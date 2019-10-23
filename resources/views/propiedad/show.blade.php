<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Propiedad</title>
    {!! Html::style('/css/pdf.css') !!}
</head>

<body>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">CP</th>
                <th scope="col">Colonia</th>
                <th scope="col">Inmobiliaria</th>
                <th scope="col">Operacion</th>
                <th scope="col">Pago</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $property->codigo }}</td>
                <td> {{ $property->codigo }}</td>
                <td> {{ $property->realstate_description }}</td>
                <td> {{ $property->operations_description }}</td>
                <td> {{ $property->form_payment_description }}</td>
            </tr>

        </tbody>
    </table>

</body>

</html>