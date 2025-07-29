<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Item</h1>
            @include('items.partials.form', [
                'action' => route('items.update', $item),
                'method' => 'PUT',
                'item' => $item
            ])
        </div>
    </div>
</div>
