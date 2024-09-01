{{-- resources/views/admin/classifications/_classification_option.blade.php --}}
<option value="{{ $classification->id }}">
    {{ str_repeat('— ', $level) . $classification->name }}
</option>
@if($classification->children->isNotEmpty())
    @foreach($classification->children as $child)
        @include('admin.classifications._classification_option', ['classification' => $child, 'level' => $level + 1])
    @endforeach
@endif
