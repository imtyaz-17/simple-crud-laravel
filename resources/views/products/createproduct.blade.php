<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-primary py-2">
        <h1 class="text-white text-center">Simple Laravel CRUD</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h3>Create New Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{route('products.store')}}" method="POST">
                        @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label h5">Name</label>
                            <input type="text" value="{{old('name')}}" class="form-control form-control-lg  @error('name') is-invalid @enderror"  placeholder="Enter Name" name="name" required>
                            <span class="text-danger">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Sku</label>
                            <input type="text" value="{{old('sku')}}" class="form-control form-control-lg  @error('sku') is-invalid @enderror" placeholder="Enter Sku" name="sku" required>
                            <span class="text-danger">
                                @error('sku')
                                     {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Price</label>
                            <input type="text" value="{{old('price')}}" class="form-control form-control-lg  @error('price') is-invalid @enderror" placeholder="Enter Price" name="price" required>
                            <span class="text-danger">
                                @error('price')
                                     {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label   h5">Description</label>
                            <textarea type="text" value="{{old('description')}}" class="form-control form-control-lg" placeholder="Description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Image</label>
                            <input type="file" value="{{old('image')}}" class="form-control form-control-lg" placeholder="" name="image">
                            <span class="text-danger">
                                @error('image')
                                     {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-info">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
  </body>
</html>