@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 6 CRUD Example from scratch </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach ($users as $users)
    <tr>
        <td>{{ $users->name }}</td>
        <td>{{ $users->email }}</td>
        <td>
            <form action="{{ route('users.destroy',$users->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('users.show',$users->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('users.edit',$users->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
