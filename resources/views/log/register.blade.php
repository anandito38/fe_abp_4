<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form | Telyu Canteen</title>
   <link rel="stylesheet" href="cssNew/style_register.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>

<body>
   
   <div class="wrapper">
      <div class="title">
            Register Form
      </div>
      <form id="RegiserForm" action="/register" method="POST">
            @csrf
            @method('post')
            <div class="field">
               <input type="text" name="fullName" id="fullName" required>
               <label for="fullName">Nama Lengkap</label>
            </div>
            <div class="field">
               <input type="text" name="nickname" id="nickname" required>
               <label for="nickname">Nickname</label>
            </div>
            <div class="field">
               <input type="text" name="phoneNumber" id="phoneNumber" required>
               <label for="phoneNumber">No Handphone</label>
            </div>
            <div class="field">
               <input type="text" name="address" id="address" required>
               <label for="address">Alamat</label>
            </div>
            <div class="field">
               <input type="password" name="password" id="password" required>
               <div style="margin-right: 10px">
                  <i class="bi bi-eye-slash"  style="float:inline-end; margin-top:-40px; margin-left:110px; position: relative" id="togglePassword"></i>
               </div>
               <label for="password">Password</label>
            </div>
            <div class="" style="margin-bottom: 30px;font-size: 17px;">
               <br>
               <center>   
                  <input type="radio" name="role" id="roleBuyer" value="Buyer" required>
                  <label for="roleBuyer">Buyer</label> ||
                  <input type="radio" name="role" id="roleSeller" value="Seller" required>
                  <label for="roleSeller">Seller</label>
               </center>
            </div>

            {{-- <input type="hidden" name="role" value="Seller"> --}}
            
            <div class="field">
               <input type="submit" value="Login">
            </div>
            <div class="signup-link">
               Already have account? <a href="/login">Login now</a>
            </div>
      </form>
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
