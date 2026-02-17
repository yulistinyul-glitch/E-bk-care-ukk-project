<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
   @vite('resources/css/app.css')
</head>
<body class="">
  <div class="min-h-screen flex items-center justify-center p-6" 
     style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">
    
    <div class="w-full max-w-md md:max-w-4xl flex flex-col items-center p-4 ">


        <div class="bg-white max-w-lg w-lg md:flex-1 p-8 md:p-10 rounded-[40px] shadow-3xl md:shrink-0">
            <h2 class="text-center text-3xl font-bold text-black mb-10">Verify code</h2>

            <form action="{{ route('otp.post')}}" method="POST" class="space-y-6">
                @csrf
                @if (session('error'))
                    <div class="text-red-500 text-sm text-center bg-red-100 p-2 rounded-xl">
                        {{ session('error')}}
                    </div>
                @endif
             
              <div class="flex gap-2 items-center justify-center">
                   <input type="text" class="otp-input w-12 h-12 text-center rounded-xl border-2 border-black" maxlength="1">
    <input type="text" class="otp-input w-12 h-12 text-center rounded-xl border-2 border-black" maxlength="1">
    <input type="text" class="otp-input w-12 h-12 text-center rounded-xl border-2 border-black" maxlength="1">
    <input type="text" class="otp-input w-12 h-12 text-center rounded-xl border-2 border-black" maxlength="1">
    <input type="text" class="otp-input w-12 h-12 text-center rounded-xl border-2 border-black" maxlength="1">
    <input type="text" class="otp-input w-12 h-12 text-center rounded-xl border-2 border-black" maxlength="1">                
                </div>

                <input type="hidden" name="otp" id="real-otp">

      
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-3xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-lg">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- java --}}
<script>
    const inputs = document.querySelectorAll('.otp-input');
    const realOtpInput = document.getElementById('real-otp');

    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
          
            if (e.target.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateRealOtp();
        });

        input.addEventListener('keydown', (e) => {
           
            if (e.key === 'Backspace' && e.target.value.length === 0 && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    function updateRealOtp() {
        let combinedValue = "";
        inputs.forEach(input => {
            combinedValue += input.value;
        });
        realOtpInput.value = combinedValue; 
        console.log("Current OTP:", combinedValue); 
    }
</script>
</body>
</html>