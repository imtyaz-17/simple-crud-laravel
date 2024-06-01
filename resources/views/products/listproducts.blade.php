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
                <a href="{{route('products.create')}}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (session('success'))
            <div class="col-md-10">
                <div class="alert alert-success mt-2">
                    {{session('success')}}
                </div>
                
            </div>
            @endif
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h3>Products list:</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Sku</th>
                                <th scope="col">Price</th>
                                <th scope="col">Craeted at</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        @if ($product->image !="")
                                        <img width="50" height="50" src="{{asset('uploads/products/'.$product->image)}}" alt="">
                                            
                                        @endif
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-dark me-2">Edit</a>
                                        <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                          </table>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
  </body>
</html>