    //  function togglePassword() {
    //         const password = document.getElementById("password");
    //         if (password.type === "password") {
    //             password.type = "text";
    //         } else {
    //             password.type = "password";
    //         }
    //  }

      function togglePassword(event, fieldId) {
            event.preventDefault(); 
            const field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
        
  