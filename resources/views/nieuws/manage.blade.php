<x-app-layout>
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage News
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($news->isEmpty())
                @foreach ($news as $item)
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="/news/{{ $item->id }}">
                            {{ $item->title }}
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="/news/{{ $item->id }}/edit" class="text-blue-400 px-6 py-2 rounded-xl">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <form action="/nieuws/{{$item->nieuws_id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa-solid fa-trash text-red-600"></i><span class="text-red-600">Delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center" >No news found</p>
                    </td>
                </tr>
                @endunless
            </tbody>
        </table>
</x-app-layout>