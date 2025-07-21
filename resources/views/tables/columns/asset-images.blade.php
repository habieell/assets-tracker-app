<div style="display: flex; gap: 5px; flex-wrap: wrap;">
    @php
        $images = is_array($getState()) ? $getState() : json_decode($getState(), true);
    @endphp

    @if ($images && count($images) > 0)
        @foreach ($images as $img)
            <img src="{{ asset('storage/' . ($img['image'] ?? $img)) }}"
                style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
        @endforeach
    @else
        <span>-</span>
    @endif
</div>