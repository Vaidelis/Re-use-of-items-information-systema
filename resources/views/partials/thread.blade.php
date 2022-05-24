

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
            <a class="delete-chat" data-id="{{$thread}}" data-bs-target="#modalCenter" data-id="{{$thread}}" data-url="{{ route('destroymessage', $thread) }}" role="button" data-bs-toggle="modal"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Ištrinti</button></a>
    </td>
</tr>

        <!-- Modal HTML -->
        <form action="" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="">
        <div id="modalCenter" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-confirm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <span style="font-size: 35px" class="material-icons">&#xE5CD;</span>
                        </div>
                        <h4 class="modal-title">Ar tikrai norite ištrinti?</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Ar tikrai norite ištrinti šį skelbimą? Po ištrynimo skelbimo nebebus.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Atšaukti</button>
                            <x-button type="submit" style="width:25px" class="btn btn-danger">Ištrinti</x-button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function () {
                // For A Delete Record Popup
                $('.delete-chat').click(function () {
                    var id = $(this).attr('data-id');
                    var url = $(this).attr('data-url');

                    $("#deleteForm", 'input').val(id);
                    $("#deleteForm").attr("action", url);
                });
            });
        </script>

