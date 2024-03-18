<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form Design | CodeLab</title>
   <link rel="stylesheet" href="cssNew/style_register.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
   <div class="wrapper">
      <div class="title">
            Login Form
      </div>
      <form id="loginForm" action="/login" method="POST">
            @csrf
            @method('post')
            <div class="field">
               <input type="text" name="nickname" id="nickname" required>
               <label for="nickname">Nama</label>
            </div>
            <div class="field">
               <input type="password" name="password" id="password" required>
               <div style="margin-right: 10px">
                  <i class="bi bi-eye-slash"  style="float:inline-end; margin-top:-40px; margin-left:110px; position: relative" id="togglePassword"></i>
                  {{-- id="togglePassword" --}}
               </div>
               <label for="password">Password</label>
            </div>
            <div class="field">
               <input type="submit" value="Login">
            </div>
            <div class="signup-link">
               Not a member? <a href="/register">Signup now</a>
            </div>
      </form>
   </div>
   <script>
      const togglePassword = document.querySelector("#togglePassword");
      const password = document.querySelector("#password");

      togglePassword.addEventListener("click", function () {
         const type = password.getAttribute("type") === "password" ? "text" : "password";
         password.setAttribute("type", type);
        // Toggle eye icon
         this.classList.toggle("bi-eye");
         this.classList.toggle("bi-eye-slash");
      });
   </script>


</body>

</html>
