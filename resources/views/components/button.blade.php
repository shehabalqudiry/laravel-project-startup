<div class="d-inline">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateModal{{ $item->id }}">
        {{ $slot }}
    </button>





    {{-- make modal bootstrap 4 for edit --}}
    @foreach ($options['modalInputsUpdate'] as $modalInputupdate)
        <div class="modal fade" id="UpdateModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form {{ $modalInputupdate['formOptions'] }} {{ $action }}>
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($modalInputupdate['data'] as $key => $input)
                                {{--  @dd($modalInputupdate['relation'])  --}}
                            <div class="form-group">
                                {{-- show image --}}
                                @if ($input['name'] == 'image')
                                    <span>
                                        @foreach (json_decode($item->{$input['name']}) as $imagesource)
                                            <img src="{{ asset($imagesource) }}" width="70px" alt="image">
                                        @endforeach
                                    </span>
                                    <br>
                                    <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                    <input type="{{ $input['type'] }}" class="form-control" id="{{ $input['name'] }}"
                                        name="{{ $input['name'] }}">
                                {{-- show video --}}
                                @elseif ($input['name'] == 'video')
                                    <span>
                                        <video width="200" height="200" controls>
                                        <source src="{{ asset($item->{$input['name']}) }}" type="video/mp4">
                                    </span>
                                    <br>
                                    <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                    <input type="{{ $input['type'] }}" class="form-control" id="{{ $input['name'] }}"
                                        name="{{ $input['name'] }}">

                                {{--show any other thing --}}
                                @else
                                    {{-- normal input --}}
                                    @if (!in_array($input['tagtype'], ['multiple', 'select', 'textarea']) and !$input['isButton'])
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        @if (str_contains($input['name'], '_ar'))
                                            @php
                                                $name = explode('_',$input['name']);
                                            @endphp
                                            <input type="{{ $input['type'] }}" class="form-control" value={{ $item->getTranslation($name[0],'ar') }}
                                            name="{{ $input['name'] }}">
                                        @elseif ($input['name'] == "images[]")
                                            <small class="form-control form-text text-muted">Please upload exactly more
                                                one images.</small>
                                            <input type="file" class="form-control" id="images"
                                                name="{{ $input['name'] }}" multiple>
                                        @else
                                            <input type="{{ $input['type'] }}" class="form-control" value={{ $item->{$input['name']} }}
                                            name="{{ $input['name'] }}">
                                        @endif
                                    {{-- multible --}}
                                    @elseif ($input['tagtype'] == 'multiple' and !$input['isButton'])
                                        <a href="{{ route('product.indexcolor',$item->id) }}" class="btn btn-primary">
                                            Mange All Attibute
                                        </a>
                                    {{-- select --}}
                                    @elseif ($input['tagtype'] == 'select' and !$input['isButton'])
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        <select class="form-control " id="{{ $input['name'] }}" name="{{ $input['name'] }}">
                                            <option value={{ $item->{$input['name']} }}>Current Value</option>
                                            @foreach ($input['optionsdata'] as $itemlist )
                                            <option value="{{ $itemlist->id }}">{{ $itemlist->name }}</option>
                                            @endforeach
                                        </select>
                                    {{-- textarea --}}
                                    @elseif ($input['tagtype'] == 'textarea' and !$input['isButton'])
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        @if (str_contains($input['name'], '_ar'))
                                            <textarea class="form-control" id="textarea" name="{{ $input['name'] }}" cols="12" rows="6">
                                                @php
                                                    $name = explode('_',$input['name']);
                                                @endphp
                                                {{ $item->getTranslation($name[0],'ar') }}
                                            </textarea>
                                        @else
                                                <textarea class="form-control" id="textarea" name="{{ $input['name'] }}" cols="12"
                                                    rows="6">{{ $item->{$input['name']} }}</textarea>
                                        @endif
                                    @endif
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</ button>
                                @foreach ($modalInputupdate['data'] as $key => $input)
                                @if ($input['isButton'])
                                    <button type="{{ $input['type'] }}" class="btn btn-primary">{{ $input['label'] }}</button>
                                @endif
                                @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
