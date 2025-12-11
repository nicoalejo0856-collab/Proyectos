 document.addEventListener('DOMContentLoaded', function() {
            
            // Elementos del formulario principal
            const form = document.getElementById("loginForm");
            const inputEmail = document.getElementById("email");
            const inputPassword = document.getElementById("password");
            const sendButton = document.getElementById("sendButton");
            const buttonText = document.getElementById("buttonText");
            const loadingSpinner = document.getElementById("loadingSpinner");
            const togglePassword = document.getElementById("togglePassword");
            const eyeIcon = document.getElementById("eyeIcon");

            // Elementos del modal de recuperación
            const recoveryModal = document.getElementById("recoveryModal");
            const forgotPasswordLink = document.getElementById("forgotPasswordLink");
            const closeModal = document.getElementById("closeModal");
            const cancelRecovery = document.getElementById("cancelRecovery");
            const recoveryForm = document.getElementById("recoveryForm");
            const recoveryEmail = document.getElementById("recoveryEmail");
            const sendRecovery = document.getElementById("sendRecovery");
            const recoveryButtonText = document.getElementById("recoveryButtonText");
            const recoverySpinner = document.getElementById("recoverySpinner");
            const successMessage = document.getElementById("successMessage");

            // Expresiones regulares
            const regularExpressions = {
                regEmail: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                regPassword: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/
            };

            // Funciones auxiliares
            function showError(input, message) {
                const errorElement = document.getElementById(`${input.id}-error`);
                input.classList.add('input-error');
                errorElement.textContent = message;
                errorElement.classList.add('show');
            }

            function clearError(input) {
                const errorElement = document.getElementById(`${input.id}-error`);
                input.classList.remove('input-error');
                errorElement.classList.remove('show');
            }

            function closeRecoveryModal() {
                recoveryModal.classList.remove("show");
            }

            // Toggle contraseña
            togglePassword.addEventListener("click", function(e) {
                e.preventDefault();
                const type = inputPassword.type === "password" ? "text" : "password";
                inputPassword.type = type;
                
                if (type === "text") {
                    eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                } else {
                    eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                }
            });

            // Abrir modal
            forgotPasswordLink.addEventListener("click", function(e) {
                e.preventDefault();
                console.log("Abriendo modal"); // Para debug
                recoveryModal.classList.add("show");
                recoveryEmail.value = "";
                successMessage.classList.add("hidden");
                clearError(recoveryEmail);
            });

            // Cerrar modal
            closeModal.addEventListener("click", closeRecoveryModal);
            cancelRecovery.addEventListener("click", closeRecoveryModal);

            recoveryModal.addEventListener("click", function(e) {
                if (e.target === recoveryModal) {
                    closeRecoveryModal();
                }
            });

            // Limpiar errores
            inputEmail.addEventListener('input', () => clearError(inputEmail));
            inputPassword.addEventListener('input', () => clearError(inputPassword));
            recoveryEmail.addEventListener('input', () => clearError(recoveryEmail));

            // Formulario de recuperación
            recoveryForm.addEventListener("submit", async function(e) {
                e.preventDefault();
                
                clearError(recoveryEmail);
                
                const emailValue = recoveryEmail.value.trim();

                if (!regularExpressions.regEmail.test(emailValue)) {
                    showError(recoveryEmail, "El correo electrónico no es válido");
                    return;
                }

                sendRecovery.disabled = true;
                recoveryButtonText.textContent = "Enviando...";
                recoverySpinner.classList.remove("hidden");

                await new Promise(resolve => setTimeout(resolve, 1500));

                sendRecovery.disabled = false;
                recoveryButtonText.textContent = "Enviar enlace";
                recoverySpinner.classList.add("hidden");
                successMessage.classList.remove("hidden");

                setTimeout(() => {
                    closeRecoveryModal();
                }, 3000);
            });

            // Formulario de login
            form.addEventListener("submit", async function(event) {
                event.preventDefault();

                clearError(inputEmail);
                clearError(inputPassword);

                const emailValue = inputEmail.value.trim();
                const passwordValue = inputPassword.value.trim();

                let hasError = false;

                if (!regularExpressions.regEmail.test(emailValue)) {
                    showError(inputEmail, "El correo electrónico no es válido");
                    hasError = true;
                }

                if (!regularExpressions.regPassword.test(passwordValue)) {
                    showError(inputPassword, "Debe tener mínimo 8 caracteres, incluir mayúscula, minúscula, número y símbolo");
                    hasError = true;
                }

                if (hasError) return;

                sendButton.disabled = true;
                buttonText.textContent = "Iniciando sesión...";
                loadingSpinner.classList.remove("hidden");

                await new Promise(resolve => setTimeout(resolve, 1500));

                sendButton.disabled = false;
                buttonText.textContent = "Iniciar sesión";
                loadingSpinner.classList.add("hidden");

                alert("✅ Formulario enviado correctamente");
            });

        });