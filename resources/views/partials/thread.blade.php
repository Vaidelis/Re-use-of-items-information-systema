<tr class="{{ $thread->isUnread(Auth::id()) ? 'font-bold' : '' }}">
    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
        <a class="hover:underline" href="{{ route('showmessage', $thread) }}">{{ $thread->creator()->name }}</a>
    </td>
    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
        <a class="hover:underline" href="{{ route('showmessage', $thread) }}">{{ $thread->subject }}</a>
    </td>
    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
        <form action="{{ route('destroymessage', $thread) }}" method="POST">
            @csrf
            @method('DELETE')

            <x-button>Ištrinti</x-button>
        </form>
    </td>
</tr>
