@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Student list</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Student code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$data->isEmpty())
                                @foreach($data as $index => $item)
                                <tr>
                                    <td>{{$perPage * ($currentPage -1) + ($index + 1)}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->age}}</td>
                                    <td class="text-center">
                                        @if($item->gender == \App\Student::MALE)
                                            <i class="fa fa-mars" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-venus" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->address}}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Data not found!</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                        <div>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
