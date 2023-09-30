document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form"),
        eyeIcons = form.querySelectorAll(".show-hide"),
        namaField = form.querySelector(".nama-field"),
        namaInput = namaField.querySelector(".nama"),
        kelompokField = form.querySelector(".kelompok-field"),
        kelompokInput = kelompokField.querySelector(".kelompok"),
        usernameField = form.querySelector(".username-field"),
        usernameInput = usernameField.querySelector(".username"),
        passField = form.querySelector(".create-password"),
        passInput = passField.querySelector(".password"),
        cPassField = form.querySelector(".confirm-password"),
        cPassInput = cPassField.querySelector(".cPassword");   
    function checkName() {
	const namaPattern = /^[a-zA-Z.,' -]{4,}$/;
        if (!namaInput.value.match(namaPattern)) {
            namaField.classList.add("invalid");
        } else {
            namaField.classList.remove("invalid");
        }
    }
    function checkKelompok() {
        const kelompokPattern = /^[0-9]+$/;
        if (!kelompokInput.value.match(kelompokPattern)) {
            kelompokField.classList.add("invalid");
        } else {
            kelompokField.classList.remove("invalid");
        }
    }

    function checkUsername() {
        const usernamePattern = /^[a-z0-9_]{5,20}$/;
        if (!usernameInput.value.match(usernamePattern)) {
            return usernameField.classList.add("invalid");
        }
        usernameField.classList.remove("invalid");
    }
        eyeIcons.forEach(eyeIcon => {
        eyeIcon.addEventListener("click", () =>{
            const pInput = eyeIcon.parentElement.querySelector("input");
            if(pInput.type === "password"){
                eyeIcon.classList.replace("bx-hide", "bx-show");
                (pInput.type = "text");
            } else {
                eyeIcon.classList.replace("bx-show", "bx-hide");
                pInput.type = "password";
            }
        });
    });

    function createPass() {
        const passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        
        if (!passInput.value.match(passPattern)) {
            passField.classList.add("invalid");
        } else {
            passField.classList.remove("invalid");
        }
    }

    function confirmPass() {
        if (passInput.value !== cPassInput.value || cPassInput.value === "") {
            return cPassField.classList.add("invalid");
        } else {
            cPassField.classList.remove("invalid");
        }
    }

     form.addEventListener("submit", async (e) => {
        e.preventDefault();
        checkName();
        checkKelompok();
        checkUsername();
        createPass();
        confirmPass();

        if (usernameInput.value.length < 5) {
            const usernameError = form.querySelector(".username-error");
            const usernameExist = form.querySelector(".username-exist");

            usernameError.style.display = "flex"; // Show the error message
            usernameExist.style.display = "none"; // Hide the username-exist message
        } else if (
            !namaField.classList.contains("invalid") &&
            !kelompokField.classList.contains("invalid") &&
            !passField.classList.contains("invalid") &&
            !cPassField.classList.contains("invalid")
        ) {
            try {
                const response = await fetch("registrasi.php", {
                    method: "POST",
                    body: new URLSearchParams(new FormData(form))
                });

                if (response.ok) {
                    const data = await response.text();
                    if (data === "Username sudah digunakan. Silakan pilih username lain.") {
                        const usernameError = form.querySelector(".username-error");
                        const usernameExist = form.querySelector(".username-exist");

                        usernameError.style.display = "none"; // Hide the username-error message
                        usernameExist.style.display = "block"; // Show the username-exist message
                    } else {
                        const usernameError = form.querySelector(".username-error");
                        usernameError.style.display = "none";
                        window.location.replace('userlogin.html');
                    }
                } else {
                    console.error("Server responded with an error");
                }

            } catch (error) {
                console.error("Error:", error);
            }
        }
    });
});	 
