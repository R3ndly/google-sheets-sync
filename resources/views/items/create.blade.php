<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create New Item</h1>
            @include('items.partials.form', ['action' => route('items.store')])
        </div>
    </div>
</div>
