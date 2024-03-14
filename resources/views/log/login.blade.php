<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Form Design | CodeLab</title>
      <link rel="stylesheet" href="css/style_register.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Login Form
         </div>
         <form action="/login" method="post">
            @csrf
            @method('post')
            <div class="field">
                  <input type="text" required>
                  <label>Nama</label>
            </div>
            <div class="field">
               <input type="email" required>
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password" required>
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
   </body>
</html>