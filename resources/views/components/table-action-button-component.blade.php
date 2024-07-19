<div class="d-inline-block">
    <a href="{{ $attributes['b_href'] }}" data-toggle="modal" data-target="#{{ $attributes['modal_id'] }}" class="{{ $attributes['b_class'] }}">{{ $attributes['b_text'] }}</a>
    <x-dynamic-modal-component :options="$attributes['options']" />
</div>
