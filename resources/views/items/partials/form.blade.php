<form action="{{ $action }}" method="POST">
    @if(isset($method))
        @method($method)
    @endif
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="Allowed" {{ (old('status', $item->status ?? '') == 'Allowed' ? 'selected' : '') }}>Allowed</option>
            <option value="Prohibited" {{ (old('status', $item->status ?? '') == 'Prohibited' ? 'selected' : '') }}>Prohibited</option>
        </select>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $item->description ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
</form>
