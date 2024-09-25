{{--  @dd($data)  --}}
@extends('layouts.app')
@section('page-title', isset($options['page_title']) ? $options['page_title'] : '')
@section('theme-content')
    @if (session()->has('done'))
        <div class="mb-3 alert alert-success" role="alert">
            {{ session()->get('done') }}
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="mb-3 alert alert-danger" role="alert">
            {{ session()->get('fail') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-3 alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br />
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card my-4 shadow">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                        @foreach ($data as $tab)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $loop->iteration }}"
                                    data-toggle="tab" href="#tab_{{ $loop->iteration }}" role="tab"
                                    aria-controls="{{ $tab->title }}" aria-selected="true">{{ $tab->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <form action="{{ route('setting.updateSetting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content my-2" id="pills-tabContent">
                            @foreach ($data as $item)
                                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                    id="tab_{{ $loop->iteration }}" role="tabpanel"
                                    aria-labelledby="tab_{{ $loop->iteration }}-tab">
                                    <div class="row">
                                        @foreach ($item->data->resource as $data_item)
                                        <div class="col-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="item{{ $loop->iteration }}" class="form-label">{{ ucwords(str_replace(['_', '-'], ' ', $data_item->key)) }}</label>
                                                <input type="{{ $data_item->type }}" id="item{{ $loop->iteration }}"
                                                    value="{{ $data_item->value ?? '' }}"
                                                    class="form-control"
                                                    name="{{ $data_item->key }}"
                                                    placeholder="{{ ucwords(str_replace(['_', '-'], ' ', $data_item->key)) }}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
