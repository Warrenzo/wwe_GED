{{-- resources/views/admin/classifications/_classification_row.blade.php --}}
<li class="list-group-item">
    <div class="d-flex justify-content-between">
        <div>
            {{ $classification->name }}
        </div>
        <div>
            <a href="{{ route('classifications.edit', $classification->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('classifications.destroy', $classification->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
            </form>
        </div>
    </div>

    @if($classification->children->isNotEmpty())
        <ul class="list-group mt-2">
            @foreach($classification->children as $child)
                @include('admin.classifications._classification_row', ['classification' => $child])
            @endforeach
        </ul>
    @endif
</li>
