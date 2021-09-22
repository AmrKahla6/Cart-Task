@extends('layouts.app')
@section('content')
    <div class="container">
        <section>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <img class="card-img-top" src="{{asset('uploads/'.$product->image)}}" width="750" height="300">
                            <div class="card-body">
                              <h5 class="card-title">{{$product->name}}</h5>
                              <p class="card-text">{{substr($product->category,0,50)}}.</p>
                              <p><strong> $ {{ $product->price }}</strong></p>
                               <p><strong> Quantity : {{ $product->quantity }}</strong></p>
                              @if ($product->available == 1)
                                  <a href="{{route('cart.add',$product->id)}}" class="btn btn-primary">Buy</a>
                              @else
                                  <a href="#"  class="btn btn-danger" disaabled>Not available</a>
                              @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$products->links()}}
        </section>
    </div>
@endsection
