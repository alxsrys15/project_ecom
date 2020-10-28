<!DOCTYPE html>
<html>
<head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style type="text/css">
      .login{
        border: 1px solid lightblue;
        border-radius: 5px;
        -webkit-box-shadow: 0 0 15px #D3D3D3;
        box-shadow: 0 0 15px #D3D3D3;
        left: 0px;
        height: 500px;
        width: 500px;
      }
      .login_header{
        position:absolute;
        left:0;
        padding-top: 2px;
        width: 100%;
        background: lightblue;
      }
      h2{
        padding-top: 5px;
        text-align: center;
      }
      .regfrm{
        margin-top: 29%;
      }
      .label{
        text-align:left;
      }

    </style>
</head>
<body><center>
  <div class="row">
       <div class="login col-sm-13 col-md-12 col-lg-12 align-self-center" >
         <div class="login_header">
           <h2><i class="glyphicon glyphicon-user"></i>Registration</h2>
         </div>
         <div class = "regfrm">
         <br>
             <form>
    <label>First Name</label><br>
    <input type="text" placeholder="First Name"><br>
    <label>Last name</label><br>
    <input type="text" placeholder="Last Name"><br>
    <label>Email</label><br>
    <input type="email" placeholder="Email"><br>
    <label>Password</label><br>
    <input type="password" placeholder="Password"><br>
    <label>Confirm Password</label><br>
    <input type="password" placeholder="Confirm Password"><br>
    <label>Contact Number</label><br>
    <input type="email" placeholder="Contact Number"><br>
    <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
  </div>
</div>
</center>
</body>
</html>