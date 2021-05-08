@extends('layouts.app')

@section('content')

    <div class="container mt-2 mb-3">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h4 class="text-center mb-5"> Todo </h4>
                <a href="{{ url('/todo') }}" style="float:right" class="btn btn-primary"><i class="fa fa-plus"></i> My Todos</a>
                <table class="table table-striped mt-2">
                    <thead>
                        <th> User </th>
                        <th> Topic </th>
                        <th> Todo_DESC </th>
                        <th> Created at </th>
                    </thead>
                    <tbody>
                        @forelse($todos as $todo)
                        <tr>
                            <td> {{ $todo->name }} </td>
                            <td> {{ $todo->title }} </td>
                            <td> {{ $todo->description }} </td>
                            <td> {{ $todo->created_at }} </td>
                        </tr>
                        @empty
                            <tr>
                            <td colspan="4"><center>No data found</center></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $todos->links() }}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
@endsection