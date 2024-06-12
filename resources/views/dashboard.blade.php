<x-app-layout>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Show latest news --}}
                    <h2 class="text-2xl font-semibold">Latest News</h2>
                    <div class="mt-4">
                        @php
                        $latestNews = $news->shift();
                        @endphp

                        @if($latestNews)
                            <div class="p-4 mb-4 bg-gray-200 rounded-lg">
                                <a href="{{ route('nieuws.show', $latestNews->id)  }}"><h1 class="text-2xl font-bold text-blue-400">{{ $latestNews->title }}</h1></a>
                                <p class="text-gray-600 dark:text-gray-300">{{Str::limit($latestNews->description, 80, $end='...') }}</p>
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($news->take(4) as $newsItem)
                                <div class="p-4 bg-gray-100 rounded-lg">
                                    <h3 class="text-xl font-semibold">{{ $newsItem->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300">{{Str::limit($newsItem->description, 100, $end='...') }}</p>
                                    <p class="text-gray-500 dark:text-gray-400">{{ $newsItem->created_at->format('F j, Y') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>