<x-app-layout>
    <form action="{{ route('nieuws.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf
    
        <div class="mb-4">
            <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Title:</label>
            <input 
            type="text" 
            name="title" 
            id="title" 
            value="{{ old('title') }}"
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="content" class="block mb-2 text-sm font-bold text-gray-700">Content:</label>
            <textarea 
            name="content" 
            id="content" 
            value="{{ old('content') }}"
            rows="5" 
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            </textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- categories --}}
        <div class="mb-4">
            <label for="category" class="block mb-2 text-sm font-bold text-gray-700">Category: <a href="/categories/create">Create a category?</a></label>
            <select name="category" id="category" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>  
        @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        {{-- Tags --}}
        <div class="mb-4">
            <label for="tags" class="block mb-2 text-sm font-bold text-gray-700">Tags: <a href="/tags/create">Create a tag?</a></label>
            <input type="text" id="tag-input" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            @error('tag')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2 suggestion-list"></div>
            <div class="mt-2 tag-list"></div>
        </div>
    
        <div class="flex items-center justify-between">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                Publish Article
            </button>
        </div>
        
    </form>
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
    