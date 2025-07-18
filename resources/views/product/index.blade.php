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

        @if (session("success"))

            <div class="alert alert-primary" role="alert">
                <strong>{{ session("success") }}</strong>
            </div>
        @endif

        @if ($errors->any())


            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="d-flex justify-content-between mt-4">
            <h1>Product List</h1>
            <form action="{{ route("logout") }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary mb-3">
                    Logout
                </button>
            </form>
        </div>

        <form action="{{ route("product.create") }}" method="GET">
            @csrf
            @if (auth()->user()->can("create-products"))

                <button type="submit" class="btn btn-primary mb-3">
                    Add product
                </button>
            @endif
        </form>

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
                        <th scope="col">Product Name</th>
                        <th scope="col">sku</th>
                        <th scope="col">hsn code</th>
                        <th scope="col">description</th>
                        <th scope="col">short_description</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($products))

                        @foreach ($products as $product)
                            <tr class="">
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>

                                <td>{{$product->sku}}</td>

                                <td>{{$product->hsn_code}}</td>

                                <td>{{$product->description}}</td>

                                <td>{{$product->short_description}}</td>

                                <td><img src="{{$product->image}}" alt="No image" width="100px"></td>

                                <td>
                                    <div class="d-grid gap-2">
                                        @if (auth()->user()->can('edit-products'))

                                            <form action="{{ route("product.edit", $product->id) }}" method="GET">
                                                <button type="submit" name="" id="" class="btn btn-primary">
                                                    Edit
                                                </button>
                                            </form>
                                        @endif
                                        @if (auth()->user()->can('delete-products'))

                                            <form action="{{ route("product.destroy", $product->id) }}" method="POST">
                                                @method("DELETE")
                                                @csrf
                                                <button type="submit" name="" id="deleteProBtn" class="btn btn-danger">
                                                    Detete
                                                </button>
                                            </form>
                                        @endif
                                        @if (auth()->user()->can('create-order'))


                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                                order
                                            </button>
                                            <form action="{{ route("create.order") }}" method="POST">
                                                @csrf
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <input hidden type="text" class="form-control" name="product_id"
                                                                    id="" aria-describedby="helpId" placeholder="" width="10px"
                                                                    value="{{ $product->id }}" />
                                                                <input hidden type="text" class="form-control" name="customer_name"
                                                                    id="" aria-describedby="helpId" placeholder="" width="10px"
                                                                    value="{{ auth()->user()->name }}" />
                                                                <input hidden type="text" class="form-control" name="user_id" id=""
                                                                    aria-describedby="helpId" placeholder="" width="10px"
                                                                    value="{{ auth()->user()->id }}" />
                                                                <div class="mb-3">
                                                                    quntity
                                                                    <input type="number" name="quantity" class="form-control"
                                                                        name="quntity" id="" aria-describedby="helpId"
                                                                        placeholder="" width="10px" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Please add Address</label>

                                                                    <textarea type="text" class="form-control" name="address" id=""
                                                                        aria-describedby="helpId" placeholder=""></textarea>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Place order</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </form>
                                        @endif

                                    </div>

                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr class="text-center">
                            <td align="center" colspan="8">
                                No products
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
    <script>
        $(document).ready(function () {
            $("#deleteProBtn").on("click", function () {
                return confirm("Are you sure you want to delete?");
            })
        });
    </script>
</body>

</html>