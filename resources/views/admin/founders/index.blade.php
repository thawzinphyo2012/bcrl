@extends('layouts.admin')

@section('title', 'Founders')
@section('kicker', 'About')
@section('heading', 'Founders')

@section('content')
    <div class="admin-toolbar">
        <p>{{ $founders->count() }} profiles</p>
        <a class="admin-btn admin-btn-gold" href="{{ route('admin.founders.create') }}">Add founder</a>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>#</th><th>Name</th><th>Role</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($founders as $founder)
                        <tr>
                            <td>{{ $founder->sort_order }}</td>
                            <td><strong>{{ $founder->name }}</strong></td>
                            <td>{{ $founder->role }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('admin.founders.edit', $founder) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.founders.destroy', $founder) }}" onsubmit="return confirm('Delete this founder?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
