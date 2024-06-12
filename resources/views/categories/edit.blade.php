<x-app-layout>
    <form action="{{ route('categories.update', $categories->id) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PATCH')
    
        <div class="mb-4">
            <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Title:</label>
            <input type="text" value="{{$categories->title}}" name="title" id="title" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"> 
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <div class="mb-4">
            <label for="description" class="block mb-2 text-sm font-bold text-gray-700">Description:</label>
            <textarea name="description" id="description" rows="5" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">{{$categories->description}}</textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <div class="flex items-center justify-between">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                Edit category
            </button>
        </div>
    </form>
</x-app-layout>