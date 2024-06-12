
<x-app-layout>
    <div class="flex flex-wrap justify-center mt-10" x-data="{ open: false }">
        <div class="mx-4 mb-4">
            <div class="p-10 bg-white rounded shadow">
                <h3 class="mb-2 text-2xl">{{ $news->title }}</h3>
                <div class="mb-4 text-xl font-bold">{{ $news->users->firstname }}</div>

                
                <div class="my-4 text-lg">
                    <i class="fas fa-location-dot"></i>date of publication: {{ $news->created_at->format('d-m-Y') }}
                </div>
                <div class="my-4 text-lg">
                    <i class="fas fa-location-dot"></i>Tags:
                    <div class="flex flex-wrap">
                        @if ($news->tags->isEmpty())
                            <span class="px-2 py-1 m-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">No tags</span>
                        @endif
                        @foreach ($news->tags as $tag)
                            <span class="px-2 py-1 m-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">{{ $tag->title }}</span>
                        @endforeach
                </div>
                <div class="my-4 text-lg">
                    <i class="fas fa-location-dot"></i>Categories:
                    <div class="flex flex-wrap">
                        @if (!isset($news->categorie))
                            <span class="px-2 py-1 m-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">No categories</span>
                        @else
                            <span class="px-2 py-1 m-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">{{ $news->categorie->title }}</span>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="space-y-6 text-lg">
                        <p>{{ $news->description }}</p>
                    </div>
                </div>
            </div>
                <div>
                    @if (auth()->id() === $news->user_id)
                        <a href="{{ route('nieuws.edit', $news->id) }}" class="text-blue-500 btn btn-primary">Edit</a>
                        <form action="{{ route('nieuws.destroy', $news->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-800 btn btn-danger"> Delete</button>
                        </form>
                    @endif
                </div>
                <div>
                    <h3 class="mb-2 text-2xl text-center">Comments</h3>
                    <div class="flex justify-center">
                        <button @click="open = true" class="px-4 py-2 text-white bg-blue-500 rounded">Add Comment</button>
                    </div>

        <div x-show="open" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                    Add Comment
                                </h3>
                                <div class="mt-2">
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="news_id" value="{{ $news->id }}">
                                        <textarea name="message" class="w-full h-20 p-2 border border-gray-200 rounded" placeholder="Write your comment..."></textarea>
                                        <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500 rounded">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="open = false" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($comments as $comment)
        <div class="w-full p-4 mx-auto mb-6 text-center bg-white border border-gray-200 rounded-lg shadow-lg sm:w-1/2">
            <div class="font-bold">{{ $comment->user->firstname }}</div>
        <div>{{ $comment->created_at->format('d-m-Y') }}</div>
        <div>{{ $comment->message }}</div>

                @if (auth()->id() === $comment->user_id)
                <a href="{{ route('comments.edit', $comment->id) }}" class="text-blue-500 btn btn-primary">Edit</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 text-red-800 btn btn-danger">Delete</button>
                    </form>
                @endif
                </div>
                @endforeach
        
    
    </div>

</x-app-layout>