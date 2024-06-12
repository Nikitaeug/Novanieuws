<div class="flex flex-wrap">
    @foreach ($tags as $tag)
        <span class="m-1 bg-blue-200 text-blue-800 text-xs font-semibold rounded-full px-2 py-1">{{ $tag }}</span>
    @endforeach
</div>