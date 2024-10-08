<div class="person-list-container" id="listContainer">
    <a class="btn btn-sm btn-danger" onclick="$('#listContainer').hide(100);"
        style="position: absolute; top:10px; right:10px;"><i class="fa fa-times"></i></a>
    <div class="person-list">
        @foreach ($myChatUserList as $item)
            <div class="person" onclick="openChat({{ $item->user->id }});">
                <img class="profile-pic">
                <div class="person-info">
                    <div class="person-name">{{ $item->user->name }}</div>
                    <div class="person-email">{{ $item->user->username }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
