@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            <thead>
                <th></th>
            </thead>
            <tbody>
                @foreach ($roles as $rol)
                    <td>{{ $rol->name }}</td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
