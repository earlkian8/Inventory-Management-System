document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const otpInputs = document.querySelectorAll('.otp-input');
    const resendLink = document.getElementById('resend-link');

    const email = sessionStorage.getItem("reset_email");
    const storedOTP = sessionStorage.getItem("reset_otp");

    const description = document.querySelector(".description");
    if (email) {
        description.textContent = `Enter the 6-digit code we sent to ${email}`;
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        let enteredOTP = "";
        otpInputs.forEach(input => {
            enteredOTP += input.value;
        });
        
        if (enteredOTP === storedOTP) {

            sessionStorage.setItem("otp_verified", "true");
            window.location.href = `change_password.php?email=${encodeURIComponent(email)}`;
        } else {

            alert("Invalid verification code. Please try again.");

            otpInputs.forEach(input => {
                input.value = "";
            });

            otpInputs[0].focus();
        }
    });

    resendLink.addEventListener("click", async function(event) {
        event.preventDefault();
        
        if (!email) {
            alert("Email not found. Please go back to the previous page.");
            return;
        }
        
        try {

            const envResponse = await fetch("../api/get_env.php");
            if (!envResponse.ok) {
                throw new Error(`Failed to fetch env: ${envResponse.status}`);
            }
            const envData = await envResponse.json();
            
            const userId = envData.EMAILJS_USER_ID;
            const serviceId = envData.EMAILJS_SERVICE_ID;
            const templateId = envData.EMAILJS_TEMPLATE_ID;

            const otp = Math.floor(100000 + Math.random() * 900000).toString();
            sessionStorage.setItem("reset_otp", otp);

            const expirationDate = new Date(new Date().getTime() + 15 * 60000);
            const timeString = expirationDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            const emailParams = {
                email: email,
                passcode: otp,
                time: timeString,
                company_name: "Inventify"
            };
            
            const emailResponse = await emailjs.send(serviceId, templateId, emailParams);
            
            if (emailResponse.status === 200) {

                resendLink.style.display = 'none';
                const timerElement = document.querySelector('.timer');
                timerElement.style.display = 'inline';
                
                let seconds = 59;
                timerElement.textContent = `Resend in ${seconds}s`;
                
                const countdown = setInterval(() => {
                    seconds--;
                    timerElement.textContent = `Resend in ${seconds}s`;
                    
                    if (seconds <= 0) {
                        clearInterval(countdown);
                        timerElement.style.display = 'none';
                        resendLink.style.display = 'block';
                    }
                }, 1000);
                
                alert("A new verification code has been sent to your email.");
            } else {
                alert("Failed to send verification code. Please try again.");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("An error occurred. Please try again later.");
        }
    });
});