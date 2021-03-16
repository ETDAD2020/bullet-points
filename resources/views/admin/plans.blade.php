@extends('layouts.master')

@section('content')
    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="pl-3">
                <h3>Plans</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pl-3 pt-2">
            <div class="row pl-3">
                <div class="col-md-12">
                    @if(count($plans)>0)
                        <table class="table table-vcenter table-striped">
                            <thead class="border-0">
                            <tr>
                                <th scope="col" class="font-weight-bold">Type</th>
                                <th scope="col" class="font-weight-bold">Name</th>
                                <th scope="col" class="font-weight-bold">Price</th>
                                <th scope="col" class="font-weight-bold">Interval</th>
                                <th scope="col" class="font-weight-bold">Capped Amount</th>
                                <th scope="col" class="font-weight-bold">Terms</th>
                                <th scope="col" class="font-weight-bold"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($plans as $plan)
                                <tr>
                                    <td class="align-middle font-weight-bold">{{ $plan->type }}</td>
                                    <td class="align-middle">{{ $plan->name }}</td>
                                    <td class="align-middle">${{ number_format($plan->price, 2) }}</td>
                                    <td class="align-middle font-weight-bold">{{ $plan->interval }}</td>
                                    <td class="align-middle">${{ number_format($plan->capped_amount, 2) }}</td>
                                    <td class="align-middle">{{ $plan->terms }}</td>
                                    <td class="align-middle">
                                        <button type="button" data-toggle="modal" data-target="#editModal{{$plan->id}}" class="btn btn-primary float-right">
                                            Edit
                                        </button>
                                        <div class="modal fade " id="editModal{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Plan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="#">Name</label>
                                                                <input placeholder="Enter Plan Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $plan->name }}"  >
                                                                @error('name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="#">Type</label>
                                                                <select name="type" id="" class="form-control">
                                                                    <option value="RECURRING" @if($plan->type == 'RECURRING') selected @endif>Recurring</option>
                                                                    <option value="ONETIME" @if($plan->type == 'ONETIME') selected @endif>One Time</option>
                                                                </select>
                                                                @error('type')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="#">Price</label>
                                                                <input placeholder="Enter Plan Price ($)" type="number" step="any" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $plan->price }}"  >
                                                                @error('price')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="#">Interval</label>
                                                                <select name="interval" id="" class="form-control">
                                                                    <option value="EVERY_30_DAYS" @if($plan->type == 'EVERY_30_DAYS') selected @endif>Every 30 Days</option>
                                                                    <option value="ANNUAL" @if($plan->type == 'ANNUAL') selected @endif>Annual</option>
                                                                </select>
                                                                @error('interval')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="#">Capped Amount</label>
                                                                <input placeholder="Enter Plan Capped Amount ($)" type="number" step="any" class="form-control @error('capped_amount') is-invalid @enderror" name="capped_amount" value="{{ $plan->capped_amount }}"  >
                                                                @error('capped_amount')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="#">Terms</label>
                                                                <textarea name="terms" id="" cols="30" rows="10" class="form-control">{{ $plan->terms }}</textarea>
                                                                @error('terms')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>





                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" >Update Plan</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            <h3>No Stores Found</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
