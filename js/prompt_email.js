document.addEventListener("DOMContentLoaded", async function() {
    const form = document.querySelector("form");
    const emailInput = document.getElementById("email");
    const helperText = document.querySelector(".helper-text");

    try {

        const envResponse = await fetch("../api/get_env.php");
        if (!envResponse.ok) {
            throw new Error(`Failed to fetch env: ${envResponse.status}`);
        }
        const envData = await envResponse.json();
        console.log("get_env.php response:", envData);

        const userId = envData.EMAILJS_USER_ID;
        const serviceId = envData.EMAILJS_SERVICE_ID;
        const templateId = envData.EMAILJS_TEMPLATE_ID;

        if (!userId || !serviceId || !templateId) {
            throw new Error("Missing EmailJS configuration: " + JSON.stringify(envData));
        }

        emailjs.init(userId);
        console.log("EmailJS initialized with User ID:", userId);

        form.addEventListener("submit", async function(event) {
            event.preventDefault();

            const email = emailInput.value.trim();

            try {

                const response = await fetch("../api/account_api.php");
                if (!response.ok) {
                    throw new Error(`Account API error: ${response.status}`);
                }

                const data = await response.json();

                if (data.status === "success") {
                    const accounts = data.acc || (data.accData ? [data.accData] : []);
                    const user = accounts.find(account => account.email === email);

                    if (user) {

                        const otp = Math.floor(100000 + Math.random() * 900000).toString();
                        sessionStorage.setItem("reset_otp", otp);
                        sessionStorage.setItem("reset_email", email);

                        const expirationDate = new Date(new Date().getTime() + 15 * 60000);
                        const timeString = expirationDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

                        const emailParams = {
                            email: email,
                            passcode: otp,
                            time: timeString,
                            company_name: "Inventify"
                        };
                        
                        console.log("Sending email with params:", emailParams);
                        const emailResponse = await emailjs.send(serviceId, templateId, emailParams);
                        console.log("EmailJS response:", emailResponse);

                        if (emailResponse.status === 200) {
                            window.location.href = `enter_otp.php?email=${encodeURIComponent(email)}`;
                        } else {
                            helperText.textContent = "Failed to send OTP.";
                            helperText.style.color = "red";
                        }
                    } else {
                        helperText.textContent = "Email not found.";
                        helperText.style.color = "red";
                    }
                } else {
                    helperText.textContent = "Error fetching accounts.";
                    helperText.style.color = "red";
                }
            } catch (error) {
                console.error("Error:", error);
                helperText.textContent = "An error occurred.";
                helperText.style.color = "red";
            }
        });
    } catch (error) {
        console.error("Failed to initialize EmailJS:", error);
        helperText.textContent = "Failed to load email service.";
        helperText.style.color = "red";
    }
});