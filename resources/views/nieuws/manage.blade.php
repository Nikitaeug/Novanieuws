<x-app-layout>
        <header>
            <h1 class="my-6 text-3xl font-bold text-center uppercase">
                Manage News
            </h1>
        </header>

        <table class="w-full rounded-sm table-auto">
            <tbody>
                @unless($news->isEmpty())
                @foreach ($news as $item)
                <tr class="border-gray-300">
                    <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                        <a href="/news/{{ $item->id }}">
                            {{ $item->title }}
                        </a>
                    </td>
                    <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                        <a href="{{ route('nieuws.edit', $item->id) }}" class="px-6 py-2 text-blue-400 rounded-xl">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </a>
                    </td>
                    <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                        <form action="{{ route('nieuws.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="text-red-600 fa-solid fa-trash"></i><span class="text-red-600">Delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                        <p class="text-center" >No news found</p>
                    </td>
                </tr>
                @endunless
            </tbody>
        </table>
</x-app-layout>