<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Enter OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo img {
            height: 40px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .description {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        .otp-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .otp-input {
            width: 50px;
            height: 60px;
            font-size: 24px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .btn {
            background-color: #4099ff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 14px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #3085e0;
        }
        
        .resend {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        
        .resend a {
            color: #4099ff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .timer {
            font-weight: 500;
            color: #666;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
        
        .footer a {
            color: #4099ff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h1>Verification Code</h1>
        
        <p class="description">Enter the 6-digit code we sent to your email address</p>
        
        <form action="change_password.html" method="get">
            <div class="otp-container">
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
            </div>
            
            <button type="submit" class="btn">Verify</button>
        </form>
        
        <div class="resend">
            <p>Didn't receive a code? <span class="timer">Resend in 59s</span></p>
            <p><a href="#" id="resend-link" style="display: none;">Resend Code</a></p>
        </div>
        
        <div class="footer">
            <p>Need help? <a href="#">Contact Support</a></p>
        </div>
    </div>
    
    <script>
        // Auto-focus next input field
        const otpInputs = document.querySelectorAll('.otp-input');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
            
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
        
        // Timer for resend button
        let seconds = 59;
        const timerElement = document.querySelector('.timer');
        const resendLink = document.getElementById('resend-link');
        
        const countdown = setInterval(() => {
            seconds--;
            timerElement.textContent = `Resend in ${seconds}s`;
            
            if (seconds <= 0) {
                clearInterval(countdown);
                timerElement.style.display = 'none';
                resendLink.style.display = 'block';
            }
        }, 1000);
    </script>

    <script src="../js/enter_otp.js"></script>
</body>
</html>