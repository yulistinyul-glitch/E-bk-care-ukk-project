<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>E-bk care chat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600;700&family=Qwigley&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style>
      .no-scrollbar::-webkit-scrollbar {display: none; }
      .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

      @keyframes messagePop {
        from { opacity: 0; transform: translateY(10px) scale(0.95); }
        to {opacity: 1; transform: translateY(0) scale(1); }
      }

      .animate-pop {
        animation: messagePop 0.2s ease-out forwards; 
      }
    </style>
</head>

<body class="font-['Poppins']">
  <section class="flex flex-col h-screen max-w-2xl md:max-w-5xl lg:max-w-full mx-auto bg-white shadow-xl relative">

    <div class="flex items-center justify-between px-4 py-3 border-b bg-white sticy top-0 z-20">
      <div class="flex items-center gap-3">

        <a href="{{ route('siswa.home')}}" class="p-2 -ml-2 hover:bg-gray-100 rounded-full transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="relative">
        <img src="{{ asset('img/guruProfile.jpg')}}" alt="James chao" class="w-10 h-10 rounded-full shadow-sm">
        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
      </div>
      <div>
        <h1 class="text-sm font-bold text-gray-800 lead-none">Mr. James chao, S.Pd</h1>
        <span class="text-[10px] text-green-600 font-medium uppercase tracking-wider">Online</span>
      </div>
    </div>
    
    <button class="p-2 hover:bg-gray-100 rounded-full transition-colors text-gray-400">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
    </button>
  </div>

  <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-4 bg-[#f0f2f5] no-scrollbar">

      <div class="flex justify-center">
                <span class="px-3 py-1 bg-slate-200 text-slate-500 text-[10px] font-bold rounded-full uppercase tracking-tighter">Hari Ini</span>
      </div>

      @foreach ($chats as $chat )
        @if ($chat->sender_type == 'bot')
          <div class="flex justify-center my-2 animate-pop">
            <div class="bg-amber-50 border border-amber-100 text-amber-800 text-[10px] px-4 py-2 rounded-2xl shadow-sm text-center italic max-w-[85%]">
              <i class="fas fa-info-circle mr-1"></i> {{ $chat->message }}
              <span class="block text-[8px] text-amber-400 mt-1 uppercase font-bold">{{ $chat->created_at->format('H:i') }}</span>
            </div>
          </div>
        
        @elseif ($chat->sender_type == 'siswa')
          <div class="flex item-md justify-end gap-2 animate-pop">
            <div class="max-w-[80%] bg-blue-950 text-white px-3 py-2.5 rounded-2xl rounded-br-none shadow-md">
              @if ($chat->file_path)
                <img src="{{ asset('storage/' . $chat->file_path) }}" alt="" class="max-w-full rounded-lg mb-2 border border-blue-800"> 
              @endif
              <p class="text-[13px] leading-relaxed">{{ $chat->message}}</p>
              <div class="flex items-center justify-end gap-1 mt-1">
               <span class="text-[9px] text-blue-200">{{ $chat->created_at->format('H:i') }}</span>
               <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300"><path d="M20 6 9 17l-5-5"/></svg>
              </div>
            </div>
          </div>

          @else
            <div class="flex items-end gap-2 animate-pop">
                <div class="max-w-[80%] bg-white text-gray-800 px-3 py-2.5 rounded-2xl rounded-bl-none shadow-sm border border-gray-200">
                    @if($chat->file_path)
                        <img src="{{ asset('storage/' . $chat->file_path) }}" class="max-w-full rounded-lg mb-2">
                    @endif
                    <p class="text-[13px] leading-relaxed">{{ $chat->message }}</p>
                    <span class="text-[9px] text-gray-400 block text-right mt-1">{{ $chat->created_at->format('H:i') }}</span>
                </div>
            </div>
        @endif  
      @endforeach
  </div>

  <div class="p-3 bg-white border-t">
    <div id="image-preview-container" class="hidden pb-3 px-2 flex items-center gap-2">
        <div class="relative inline-block">
            <img id="image-preview" src="#" class="w-20 h-20 object-cover rounded-lg border shadow-sm">
            <button onclick="removePreview()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <form id="chat-form" class="flex items-center gap-2 max-w-3xl mx-auto">
        <div class="flex-1 flex items-center bg-gray-100 rounded-2xl px-3 border border-transparent focus-within:border-blue-400 focus-within:bg-white transition-all shadow-inner">
            <button type="button" onclick="document.getElementById('file-input').click()" class="text-gray-400 hover:text-blue-500 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.51a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
            </button>
            <input type="file" id="file-input" class="hidden" accept="image/*">
            
            <textarea id="user-input" rows="1" class="w-full bg-transparent border-none focus:ring-0 text-sm py-3 px-2 resize-none no-scrollbar" placeholder="Ketik pesan..."></textarea>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-all shadow-lg active:scale-90 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-0.5"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
        </button>
    </form>
</div>

</section>

{{-- js --}}
<script>
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const chatBox = document.getElementById('chat-box');
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('image-preview-container');
    const previewImg = document.getElementById('image-preview');

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Preview Gambar
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    function removePreview() {
        fileInput.value = "";
        previewContainer.classList.add('hidden');
    }

    chatForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const message = userInput.value.trim();
      const file = fileInput.files[0];

      if (!message && !file) return;

      const formData = new FormData();
      formData.append('message', message);
      if (file) formData.append('file', file);
      formData.append('_token', '{{ csrf_token() }}');

      try {
        const response = await fetch("{{ route('siswa.chat.send') }}" , {
          method:'POST',
          body:formData
        });

        const result = await response.json();

        if (result.status === 'success') {
          let contentHtml = "";
          if (result.file_url) {
            contentHtml += `<img src="${result.file_url}" class="max-w-full rounded-lg mb-2 shadow-sm border border-blue-400">`
          }
          if (result.message) {
            contentHtml += `<p class="text-[13px] leading-relaxed">${result.message}</p>`;
          }

          const myMessage = `
            <div class="flex items-end justify-end gap-2 animate-pop mr-6">
                <div class="max-w-[80%] bg-blue-950 text-white px-3 py-2.5 rounded-2xl rounded-br-none shadow-md">
                  ${contentHtml}
                    <div class="flex items-center justify-end gap-1 mt-1">
                      <span class="text-[9px] text-blue-100">${result.time}</span>
                         <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-100"><path d="M20 6 9 17l-5-5"/></svg>
                    </div>
                </div>
           </div>
          `;

          chatBox.insertAdjacentHTML('beforeend', myMessage);
          userInput.value = '';
          removePreview();
          scrollToBottom();
        }
      } catch (error) {
        alert("Gagal mengirim pesan, coba lagi. ");
      }
    });

    // Auto resize textarea
    userInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>

</body>
</html>