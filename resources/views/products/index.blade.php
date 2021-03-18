@extends('layouts.master')

@section('content')
    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="pl-3 d-flex justify-content-between">
                <h3>Products</h3>
                <div>
                    <a href="{{ route('sync.products') }}" class="btn btn-primary">Sync Products 1</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pl-3 pt-2">
            <div class="row pl-3">
                <div class="col-md-12">
                    <table class="table table-vcenter table-striped">
                        <thead class="border-0">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" class="font-weight-bold w-100">Title</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row"><img src="{{ $product->img }}" alt="" style="width: 90px; height: auto"></th>
                                <td class="align-middle">{{ $product->title }}</td>
                                <td class="align-middle"><a class="btn btn-primary" href="{{ route('products.show', $product->id) }}">Add Bullet Points</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
