

    @if($thread->isUnread(Auth::id()) == true)
        <tr style="background-color: #0f5132 !important">
    <td style="background-color: #a9a9a9 !important" class="px-5 text-sm bg-white border-b border-gray-200">
        <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}"><b>{{ $thread->creator()->name }}</b></a>
    </td>
    <td style="background-color: #a9a9a9 !important" class="px-5 text-sm bg-white border-b border-gray-200">
        <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}"><b>{{ $thread->subject }}</b></a>
    </td>
            <td style="background-color: #a9a9a9 !important" class="px-5 text-sm bg-white border-b border-gray-200">
    @else
        <tr>
        <td class="px-5 text-sm bg-white border-b border-gray-200">
            <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}">{{ $thread->creator()->name }}</a>
        </td>
        <td class="px-5 text-sm bg-white border-b border-gray-200">
            <a style="color: #0b0b0b" href="{{ route('showmessage', $thread) }}">{{ $thread->subject }}</a>
        </td>
            <td class="px-5 text-sm bg-white border-b border-gray-200">
    @endif

        <form action="{{ route('destroymessage', $thread) }}" method="POST" onclick="return confirm('Ar tikrai norite ištrinti šį pokalbį?')">
            @csrf
            @method('DELETE')

            <x-button style="width: 120px;height: 40px; border: none !important" class="btn3 btn-primary">Ištrinti</x-button>
        </form>
    </td>
</tr>
