<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <style>
        #messageIcon {
            display: inline-flex;
            /* İkonun boyutlarına göre esnek hizalama */
            align-items: center;
            /* İkonu dikeyde ortalar */
            justify-content: center;
            /* İkonu yatayda ortalar */
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 50px;
            height: 50px;
            background-color: #4158D0;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
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
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70%;
            height: 70%;
            background-color: #f0f0f0;
            border-radius: 70%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            animation: animateShadowColor 2s infinite;
            transition: background-color 1s, box-shadow 1s;
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
            width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .chat-header {
            background-color: #4CAF50;
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

        .person-list {
    width: 300px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
}

.person {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s;
}

.person:hover {
    background-color: #f9f9f9;
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
    @yield('content')

    <div class='message-container'>
        @foreach ($users as $item)
            <li>
                <a onclick='getChat({{ $item->id }})'></a>{{ $item->id }}
            </li>
        @endforeach
    </div>
    <div id='messageIcon' class='icon-container'>
        <i class='fa fa-comment ikon'>
        </i>
    </div>

    <div class="chat-container">
        <div class="chat-header">Sohbet</div>
        <div class="chat-content">
            <div class="chat-message sender">
                <div class="chat-name">Ali</div>
                <div class="chat-text">Merhaba! Nasılsın?</div>
            </div>
            <div class="chat-message receiver">
                <div class="chat-name">Ayşe</div>
                <div class="chat-text">İyi, teşekkürler! Sen nasılsın?</div>
            </div>
            <div class="chat-message sender">
                <div class="chat-name">Ali</div>
                <div class="chat-text">Ben de iyiyim. Bugün ne yapıyorsun?</div>
            </div>
            <div class="chat-message receiver">
                <div class="chat-name">Ayşe</div>
                <div class="chat-text">Bugün alışverişe çıkmayı planlıyorum.</div>
            </div>
        </div>
        <div class="person-list">
            <div class="person">
                <img src="https://via.placeholder.com/50" alt="Profile Picture" class="profile-pic">
                <div class="person-info">
                    <div class="person-name">Ali Veli</div>
                    <div class="person-email">ali.veli@example.com</div>
                </div>
            </div>
            <div class="person">
                <img src="https://via.placeholder.com/50" alt="Profile Picture" class="profile-pic">
                <div class="person-info">
                    <div class="person-name">Ayşe Yılmaz</div>
                    <div class="person-email">ayse.yilmaz@example.com</div>
                </div>
            </div>
            <div class="person">
                <img src="https://via.placeholder.com/50" alt="Profile Picture" class="profile-pic">
                <div class="person-info">
                    <div class="person-name">Mehmet Demir</div>
                    <div class="person-email">mehmet.demir@example.com</div>
                </div>
            </div>
        </div>
        
        <form action="{{ route('message.insert') }}" method="POST" id='myForm'>
            <input type="hidden" name="receiver_id" id="receiver_id" value="2"/>
            @csrf
            <div class="chat-input">
                <input type="text" placeholder="Mesaj yazın..." name="message">
                <button>Gönder</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Sayfanın yeniden yüklenmesini önler

            // Form verilerini topla
            const formData = new FormData(this);

            // AJAX isteği oluştur
            fetch("{{route('message.insert')}}", {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json()) // Dönen yanıtı JSON formatında al
                .then(data => {
                    console.log(data); // JSON yanıtını konsola yazdır
                })
                .catch(error => {
                    console.error('Hata oluştu:', error); // Hata durumunda mesajı yazdır
                });
        });
    </script>
</body>

</html>
