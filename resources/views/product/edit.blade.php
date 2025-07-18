<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <h1>Edit Product</h1>

        <form action="{{ route("product.update", $product->id) }}" method="POST" class="container mb-3"
            enctype="multipart/form-data">
            @method("PUT")
            @csrf

            <div class="form-group">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder=""
                        value="{{ $product->name }}" />
                    @error("name")
                        <span class="text-danger">{{{ $message }}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">sku</label>
                    <input type="text" class="form-control" name="sku" id="" aria-describedby="helpId" placeholder=""
                        value="{{ $product->sku }}" />
                    @error("sku")
                        <span class="text-danger">{{{ $message }}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">hsn code</label>
                    <input type="text" class="form-control" name="hsn_code" id="" aria-describedby="helpId"
                        placeholder="" value="{{ $product->hsn_code }}" />
                    @error("hsn_code")
                        <span class="text-danger">{{{ $message }}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea type="text" class="form-control" name="description" id="" aria-describedby="helpId"
                        placeholder="" value="">{{ $product->description }}</textarea>
                    @error("description")
                        <span class="text-danger">{{{ $message }}}</span>
                    @enderror
                </div>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Short Description</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder=""
                    name="short_description" value="{{ $product->short_description }}">
                @error("short_description")
                    <span class="text-danger">{{{ $message }}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Choose product image</label>
                <input type="file" class="form-control" name="image" id="" placeholder=""
                    aria-describedby="fileHelpId" />
                @error("image")
                    <span class="text-danger">{{{ $message }}}</span>
                @enderror
            </div>
            <img src="{{ asset($product->image) }}" alt="" width="100px">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


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