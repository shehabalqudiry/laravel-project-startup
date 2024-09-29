@extends('layouts.app')

@section('theme-content')
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">Color table</h5>
            <p class="card-text">contextual classes to color table rows or individual cells.</p>
            <table class="table table-sm table-hover table-borderless">
                <thead>
                    <tr>
                        @foreach ($options['columns'] as $key => $column)
                        <th>{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        @foreach ($options['columns'] as $key => $column)
                        <td>{{ $item->{$key} }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
