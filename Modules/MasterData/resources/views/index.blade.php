@extends('layouts.app')

@section('theme-content')
    @if (in_array('page_title', $options))
        <h1 class="page-title">{{ $options['page_title'] }}</h1>
    @endif
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-sm table-hover table-borderless">
                <thead>
                    <tr>
                        @foreach ($options['columns'] as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                        @if ($options['actions'] != [])
                            <th>{{ __('Actions') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            @foreach ($options['columns'] as $columnKey => $column)
                                <td>{{ $item->{$columnKey} }}</td>
                            @endforeach

                            @if ($options['actions'] != [])
                                <td>
                                    @foreach ($options['actions'] as $action)
                                        {!! $action !!}
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
