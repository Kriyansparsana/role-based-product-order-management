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
            <form action="{{ route("logout") }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary mb-3">
                    Logout
                </button>
            </form>
        </div>

        <div class="container">
            <h2 class="mb-4">Order Details</h2>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <strong>Product Information</strong>
                </div>
                <div class="card-body">
                    @if($product)
                        <p><strong>Product ID:</strong> {{ $product->id }}</p>
                        <p><strong>Name:</strong> {{ $product->name }}</p>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                    @else
                        <p>No product data available.</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>User Information</strong>
                </div>
                <div class="card-body">
                    @if($user)
                        <p><strong>User ID:</strong> {{ $user->id }}</p>
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    @else
                        <p>No user data available.</p>
                    @endif
                </div>
            </div>
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