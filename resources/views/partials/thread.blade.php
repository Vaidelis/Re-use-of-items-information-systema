
<tr class="{{ $thread->isUnread(Auth::id()) ? 'font-bold' : '' }}">
    @if($thread->isUnread(Auth::id()) == true)

    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
        <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}"><b>{{ $thread->creator()->name }}</b></a>
    </td>
    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
        <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}"><b>{{ $thread->subject }}</b></a>
    </td>

    @else
        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
            <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}">{{ $thread->creator()->name }}</a>
        </td>
        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
            <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}">{{ $thread->subject }}</a>
        </td>
    @endif
    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
        <form action="{{ route('destroymessage', $thread) }}" method="POST">
            @csrf
            @method('DELETE')

            <x-button class="btn3 btn-primary">Ištrinti</x-button>
        </form>
    </td>
</tr>
