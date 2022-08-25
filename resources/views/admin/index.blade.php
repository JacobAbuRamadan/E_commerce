     @extends('admin.master')

     @section('title', 'Admin Dashboard')

     @section('content')

     <div class="row">
        <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                 <div  class="d-flex align-items-center justify-content-between">

                    <div>

                        <br>
                        <div><h1>{{ $users }}</h1></div>
                        <div>Users</div>
                        <br><br>

                        </div>

                        </div>
        </div>
        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-secondary">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
        <div>

        <br>
        <div><h1>{{ $categories }}</h1></div>
        <div>Categorys</div>
        <br><br>

        </div>
        </div>
        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
        <div>

        <br>
        <div><h1>{{ $products }}</h1></div>
        <div>Products</div>
        <br><br>

        </div>
        </div>
        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
        <div>

        <br>
        <div><h1>{{ $quantity }}</h1></div>
        <div>Quantity</div>
        <br><br>

        </div>
        </div>
        </div>
        </div>


        </div>
     @stop
