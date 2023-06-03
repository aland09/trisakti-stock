<button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#{{ 'image' . $data }}">
    <img src="{{ asset('storage/' . $image) }}" alt="{{ 'image' . $data }}" class="w-100" style="max-width: 60px">
</button>

<div class="modal fade" id="{{ 'image' . $data }}" tabindex="-1" aria-labelledby="{{ 'image' . $data }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <img src="{{ asset('storage/' . $image) }}" class="w-100">
    </div>
</div>
