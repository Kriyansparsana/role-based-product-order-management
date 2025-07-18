<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between mt-4">
            <h1>Order List</h1>
            <form action="{{ route("logout") }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary mb-3">
                    Logout
                </button>
            </form>
        </div>

        <form action="{{ route("show.orders") }}" method="GET">
            @csrf
            @if (auth()->user()->can("view-order"))

                <button type="submit" class="btn btn-primary mb-3">
                    See Orders
                </button>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">User id</th>
                        <th scope="col">Product id</th>
                        <th scope="col">customer Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($orders))
                        @foreach ($orders as $order)
                            <tr class="">
                                <td>{{$order->id}}</td>
                                <td>{{$order->product_id}}</td>

                                <td>{{$order->user_id}}</td>

                                <td>{{$order->customer_name}}</td>

                                <td>{{$order->quantity}}</td>

                                <td>{{$order->shipping_address}}</td>

                                <td>

                                    <form action="{{ route("order.details") }}" method="GET">
                                        <div class="d-grid gap-2">
                                            <input hidden type="text" name="order_id" value="{{ $order->id }}">
                                            <button type="submit" name="" id="" class="btn btn-primary">
                                                Order Details
                                            </button>
                                        </div>
                                    </form>

                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr class="text-center">
                            <td align="center" colspan="7">
                                No orders
                            </td>
                        </tr>
                    @endif


                </tbody>
            </table>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>