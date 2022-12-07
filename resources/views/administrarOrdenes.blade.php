<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</head>

<body>

    <div id="nav">
        <div class="titulonav">
            Filtrar
        </div>

        <div class="cuerporec">
            <ul>
                <li><a href="#">Todos los pedidos</a></li>
                <li><a href="#">Pedidos pendientes</a></li>
                <li><a href="#">Pedidos Finalizados</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <h4>Resumen de pedidos</h4>
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table class="table table-stripped">
                        <thead>

                            <tr>
                                <th>Numero de pedido</th>
                                <th>Numero de mesa</th>
                                <th>Monto Total</th>
                                <th>Ver detalle</th>
                                <th>Asignar Tiempo</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($resumen_pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->mesa_id }}</td>
                                    <td>${{ $pedido->montoTotal }}</td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#Modal-{{ $pedido->id }}">Ver detalle</button></td>

                                    <td><button>Asignar Tiempo</button></td>
                                </tr>
                                <div class="modal fade" id="Modal-{{ $pedido->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle del pedido
                                                    #{{ $pedido->id }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div>Productos:</div>
                                                @foreach ($pedido->detallesOrden as $detalle)
                                                    <div>{{ $detalle->cantidad }}x {{ $detalle->productoId->nombre }}
                                                        Monto: ${{ $detalle->productoId->precio * $detalle->cantidad }}
                                                    </div>
                                                @endforeach

                                                <div class="mt-3">Total: ${{ $pedido->montoTotal }}</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>


</html>
