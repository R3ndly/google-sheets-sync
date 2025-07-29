<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h1>Items</h1>
            <a href="{{ route('items.create') }}" class="btn btn-primary">Create New</a>
            <button onclick="document.getElementById('generate-form').submit()" class="btn btn-success">Generate 1000 Items</button>
            <button onclick="document.getElementById('clear-form').submit()" class="btn btn-danger">Clear All</button>

            <form id="generate-form" action="{{ route('items.generate') }}" method="POST" class="d-none">
                @csrf
            </form>

            <form id="clear-form" action="{{ route('items.clear') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <form action="{{ route('items.update-sheet') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="url" name="sheet_url" class="form-control" placeholder="Google Sheet URL" value="{{ old('sheet_url', $sheetUrl ?? '') }}" required>
                    <button type="submit" class="btn btn-primary">Set Sheet URL</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
