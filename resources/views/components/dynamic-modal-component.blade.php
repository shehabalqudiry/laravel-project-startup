@foreach ($options['modalInputs'] as $modalInput)
    @if (str_contains($modal_id, 'modal-edit'))
        <div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form {{ $modalInput['formOptions'] }} {{ $action }}>
                        @csrf
                        @isset($modalInput['method'])
                            @method($modalInput['method'])
                        @endisset
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($modalInput['data'] as $key => $input)
                                <div class="form-group">
                                    @if (!$input['isButton'])
                                        @include('components.form-input', [
                                            'input' => $input,
                                            'item' => $item,
                                            'old' => old($input['name'], $item->{$input['name']} ?? ''),
                                        ])
                                    @endif

                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">{{ __('Close') }}
                                </ button>
                                @foreach ($modalInput['data'] as $key => $input)
                                    @if ($input['isButton'])
                                        <button type="{{ $input['type'] }}"
                                            class="btn btn-outline-success">{{ $input['label'] }}</button>
                                    @endif
                                @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif(str_contains($modal_id, 'modal-delete'))
        <div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form {{ $modalInput['formOptions'] }} {{ $action }}>
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this item?</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">{{ __('Close') }}
                                </ button>
                                <button type="submit" class="btn btn-outline-danger">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif(str_contains($modal_id, 'modal-show'))
    <div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header  text-white">
                    <h5 class="modal-title" id="modalLabel">{{ __('Details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            @foreach ($columns as $columnKey => $col)
                                <tr>
                                    <th class="text-start">{{ $col }}</th>
                                    <td class="text-start">{!! $item->{$columnKey} !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach
