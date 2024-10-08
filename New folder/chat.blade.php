<style>
    #messageIcon {
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        width: 50px;
        height: 50px;
        background: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        filter: blur(0px);
        position: fixed;
        right: 20px;
        bottom: 20px;
    }

    #messageIcon i {
        font-size: 190%;
        color: burlywood;

    }

    .icon-container {
        z-index: 999;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 70%;
        height: 70%;
        background-color: #f0f0f0;
        border-radius: 70%;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 1s, box-shadow 1s;
    }

    .animateChatIcon {
        animation: animateShadowColor 2s infinite;
    }

    i.ikon {
        font-size: 170%
    }

    @keyframes animateShadowColor {
        0% {
            background-color: #fff203;
            box-shadow: 0px 0px 0px 0px rgba(255, 238, 0, 0.2);
        }

        50% {
            background-color: #ff0f02;
            box-shadow: 00px 00px 30px 5px rgb(191, 0, 255, 0.8);
        }

        100% {
            background-color: #bb00ff;
            box-shadow: 0px 0px 0px 0px rgb(166, 0, 255, 0.2);
        }
    }

    .chat-container {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        max-width: 400px;
        margin: 0 auto;
        border: 1px solid #ccc;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
        z-index: 999999999;
        display: none;

    }

    .chat-header {
        background: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);

        color: white;
        padding: 10px;
        text-align: center;
        font-size: 18px;
        border-radius: 10px 10px 0 0;
    }

    .chat-content {
        padding: 10px;
        height: 300px;
        overflow-y: auto;
        border-bottom: 1px solid #ccc;
    }

    .chat-message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 10px;
    }

    .sender {
        background-color: #d1e7dd;
        text-align: left;
    }

    .receiver {
        background-color: #f8d7da;
        text-align: right;
    }

    .chat-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .chat-text {
        font-size: 14px;
    }

    .chat-input {
        display: flex;
        padding: 10px;
        background-color: #fff;
        border-radius: 0 0 10px 10px;
    }

    .chat-input input {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        font-size: 14px;
    }

    .chat-input button {
        padding: 10px 15px;
        border: none;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .chat-input button:hover {
        background-color: #45a049;
    }

    .person-list-container {
        border-radius: 7px 0px 0 7px;
        background: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        width: 230px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999999;
        display: none;
    }

    .person-list {


        width: 300px;
        font-family: Arial, sans-serif;

        border-radius: 5px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    .person {
        border-radius: 8px;
        margin: 6px;
        background: linear-gradient(50deg,
                rgba(255, 255, 255, 0.4) 12%,
                rgba(255, 255, 255, 0.1) 77%);
        background-blend-mode: ;
        box-shadow: 0px 4px 24px 1px rgba(0, 0, 0, 0.28);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        cursor: pointer;
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        transition: background-color 0.3s;
    }

    .person:hover {
        background-color: #f9f9f9;
    }

    .personNewMessage {
        background-color: #9aff00;
    }

    .profile-pic {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .person-info {
        display: flex;
        flex-direction: column;
    }

    .person-name {
        font-size: 16px;
        font-weight: bold;
    }

    .person-email {
        font-size: 14px;
        color: #555;
    }
</style>
<div id='messageIcon' onclick="$('#listContainer').show(100).css('display','flex')" class='icon-container'>
    <i class='fa fa-comment ikon' style="position:relative; display: flex; justify-content:center; align-items:center;">
        <b style="color:#00008b; position: absolute; top:-2px; right:7px;"></b>
    </i>
</div>
<div class="person-list-container" id="listContainer">
    @include('chatUserList')
</div>
<div class="chat-container" id="chatContainer">
    <a class="btn btn-sm btn-danger" onclick="$('#receiverId').val(''); $('#chatContainer').hide(100);"
        style="position: absolute; top:10px; right:10px;"><i class="fa fa-times"></i></a>
    <div class="chat-header">Sohbet</div>
    <div class="chat-content" id="messages">

    </div>
    <form action="{{ route('message.send') }}" method="POST" id='chatForm'>
        <input type="hidden" name="receiver_id" id="receiverId" value="" />
        @csrf
        <div class="chat-input">
            <input type="text" placeholder="Mesaj yazın..." name="message" id="messageInput" required>
            <button>Gönder</button>
        </div>
    </form>
</div>
<script>
    var openChat;
    var checkNew;
    var sendMessage;
</script>
<script type="module">
    var div1 = $('#chatContainer');
    var div2 = $('#listContainer');
    var div3 = $('#messageIcon');
    var referans = 0;
    $(document).click(function(event) {
        if (!$(event.target).closest('#chatContainer, #listContainer, #messageIcon').length) {
            $('#chatContainer').hide();
            $('#listContainer').hide();
        };
    });
    var j = 0;
    var ses = new Audio("/ses.mp3");
    checkNew = function(userId = null) {
        console.log(userId); //
        $.ajax({
            url: "{{ route('message.checkNew') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: userId
            },
            dataType: "json",
            success: function(response) {
                 console.log(response);
                if (response.status == 1) {
                    $('#messageIcon').removeClass('animateChatIcon').addClass('animateChatIcon');
                    $('.ikon').find("b").html(response.count);
                    if (response.newMessage == 1) {
                        $('#messages').append(response.messagesHtml);
                        $('#messages').animate({
                            scrollTop: $('#messages')[0].scrollHeight
                        }, 1000);
                    } else {
                        if (j != response.count) {
                            ses.play();
                            j = response.count;
                        }
                    }
                    $('#listContainer').html(response.chatUserListHtml);
                } else {
                    $('#messageIcon').removeClass('animateChatIcon');
                    $('.ikon').find("b").html(0);
                }
            },
            error: function(xhr, status, error) {
                console.error('Hata oluştu:', error);
            }
        });
    }
    setInterval(() => {
        var userId = $('#receiverId').val();
        checkNew(userId);
    }, 5000);
    openChat = function(userId) {
        $('#receiverId').val(userId);
        $.ajax({
            beforeSend: function() {
                $("#loader").css("display", "flex");
            },
            complete: function() {
                $("#loader").hide();
            },
            url: "{{ route('message.getMessagesByUserId') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                userId: userId
            },
            dataType: "json",
            success: function(response) {
                $('#chatContainer').show(100);
                $('#messageInput').focus();
                if (response.status == 1) {
                    $('#listContainer').html(response.chatUserListHtml);
                    $('#messages').html(response.html);
                    $('#messages').animate({
                        scrollTop: $('#messages')[0].scrollHeight
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                console.error('Hata oluştu:', error);
            }
        });
    }
    $('#chatForm').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('message.send') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.status == 1) {
                    $('#messageInput').val('');
                    $('#messages').animate({
                        scrollTop: $('#messages')[0].scrollHeight
                    }, 1000);
                    $('#messages').append(response.html);
                }
            },
            error: function(xhr, status, error) {
                console.error('Hata oluştu:', error);
            }
        });
    });
</script>
