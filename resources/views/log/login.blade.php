<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Form Design | CodeLab</title>
      <link rel="stylesheet" href="css/style_register.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />


   </head>
   <body>
      <div class="wrapper ">
         <div class="title">
            Login Form
         </div>
         <form action="/login" method="post">
            @csrf
            @method('post')
            <div class="field">
                  <input type="text" name="nickname" required>
                  <label>Nama</label>
            </div>
            <div class="field">
               <input type="password" name="password" id="password" required>
               <div style="margin-right: 10px"> <i class="bi bi-eye-slash" id="togglePassword" style="float:inline-end; margin-top:-40px; margin-left:110px; position: relative"></i></div>
               <label>Password</label>
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
               // toggle the type attribute
               const type = password.getAttribute("type") === "password" ? "text" : "password";
               password.setAttribute("type", type);
               
               // toggle the icon
               this.classList.toggle("bi-eye");
         });
         // prevent form submit
         const form = document.querySelector("form");
         form.addEventListener('submit', function (e) {
               e.preventDefault();
         });
      </script>
   </body>
</html>