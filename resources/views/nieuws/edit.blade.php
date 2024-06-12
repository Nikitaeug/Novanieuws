<x-app-layout>
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Edit News Article</h1>
    </div>

    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <form method="POST" action="/nieuws/{{$news->id}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 space-y-6 bg-white sm:p-6">

                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Article Title
                            </label>
                            <input type="text" name="title" id="title" value="{{$news->title}}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    @error('title')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    {{-- Select tags (multiple) --}}
                    <div class="mb-4">
                        <label for="tags" class="block mb-2 text-sm font-bold text-gray-700">Tags</label>
                        <input type="text" id="tag-input" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        @error('tags')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mt-2 suggestion-list"></div>
                        <div class="mt-2 tag-list">
                            @foreach($news->tags as $tag)
                                <div class="flex items-center inline-block px-4 py-1 mb-2 mr-2 text-blue-700 bg-blue-100 rounded-full tag">
                                    <input type="hidden" name="tags[]" value="{{ $tag->id }}">
                                    <span class="mr-2">{{ $tag->title }}</span>
                                    <button type="button" class="font-bold text-red-500 remove-tag hover:text-red-700">X</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Select categories --}}
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="categories" class="block text-sm font-medium text-gray-700">
                                Categories
                            </label>
                            <select name="categories" id="categories" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $news->category_id) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('categories')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Article Content
                        </label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{$news->description}}</textarea>
                        </div>
                    </div>
                    
                </div>
                @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                

                <div class="flex justify-center px-4 py-3 sm:px-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-black border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                        Edit Article
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
<script>
    const tags = @json($tags);
    const tagInput = document.getElementById('tag-input');

    tagInput.addEventListener('input', function() {
        const value = this.value.trim();
        const tag = tags.find(tag => tag.title.toLowerCase() === value.toLowerCase());

        if (tag) {
            this.value = '';
            addTag(tag);
            suggestionList.innerHTML = '';
        } else {
            // Display tags which contain the input value
            const filteredTags = tags.filter(tag => tag.title.toLowerCase().includes(value.toLowerCase()));
            console.log(filteredTags);

            suggestionList = document.querySelector('.suggestion-list');
            suggestionList.innerHTML = '';
            if (filteredTags.length && value.length > 0) {
                filteredTags.forEach(tag => {
                    const suggestion = document.createElement('p');
                    suggestion.classList.add('suggestion', 'bg-gray-100', 'text-gray-700', 'rounded', 'px-2', 'py-1', 'mb-1', 'cursor-pointer');
                    suggestion.textContent = tag.title;
                    suggestion.addEventListener('click', () => {
                        addTag(tag);
                        tagInput.value = '';
                        suggestionList.innerHTML = '';
                    });
                    suggestionList.appendChild(suggestion);
                });
            }
        }
    });

    function addTag(tag) {
        const tagId = tag.id;
        const tagList = document.querySelector('.tag-list');
        const tagInputName = 'tags[]';

        // Check if the tag is already added
        if (!Array.from(tagList.querySelectorAll('input')).some(input => input.value == tagId)) {

            const tagElement = document.createElement('div');
            tagElement.classList.add('tag', 'inline-block', 'bg-blue-100', 'text-blue-700', 'rounded-full', 'px-4', 'py-1', 'mr-2', 'mb-2', 'flex', 'items-center');

            tagElement.innerHTML = `
                <input type="hidden" name="${tagInputName}" value="${tagId}">
                <span class="mr-2">${tag.title}</span>
                <button type="button" class="font-bold text-red-500 remove-tag hover:text-red-700">X</button>
            `;

            tagList.appendChild(tagElement);
        }
    }

    // Add listener to remove tags
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-tag')) {
            e.target.parentElement.remove();
        }
    });
</script>
