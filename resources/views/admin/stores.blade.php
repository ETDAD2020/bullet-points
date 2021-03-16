@extends('layouts.master')

@section('content')
    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="pl-3">
                <h3>Stores</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pl-3 pt-2">
            <div class="row pl-3">
                <div class="col-md-12">
                    @if(count($users)>0)
                        <table class="table table-vcenter table-striped">
                            <thead class="border-0">
                            <tr>
                                <th scope="col" class="font-weight-bold">Name</th>
                                <th scope="col" class="font-weight-bold">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="align-middle">{{ explode('.', $user->name)[0] }}</td>
                                    <td class="align-middle">{{ $user->name }}</td>
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
