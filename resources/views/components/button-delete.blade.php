<div class="d-inline">
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $item->id }}">
        {{ $slot }}
    </button>


    <div class="modal fade" id="DeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="DeleteModal{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteModal{{ $item->id }}">Confirm Delete</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form {{ $options['modaldelete']['formOptions'] }} {{ $action }}>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
