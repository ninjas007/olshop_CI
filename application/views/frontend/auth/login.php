<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Font comforta -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <style>
    * {
      margin: 0;
      padding: 0;
    }

    body {
      background: url('https://as1.ftcdn.net/jpg/01/49/99/24/500_F_149992470_ayNdi7hRxnSL9FtEp3uvj2QZYBrjWRDw.jpg') fixed;
    }
    
    #card-wrapper {
      width: 40%;
    }

    @media only screen and (max-width: 600px) {
      #card-wrapper {
      width: 100%
      }
    }

    </style>
    
    <title>Login</title>
  </head>
  <body>
    <center>
    <form action="<?php echo base_url('process') ?>" method="POST">     
      <div class="card" id="card-wrapper" style="height: 100%; margin-top: 50px; background: #68c93e;">
        <h4 class="card-header bg-dark text-white">Login User</h4>
        

        <div class="card-body" style="padding: 20%;">
          <?php echo $this->session->flashdata('alert') ?>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="m-3">Belum punya akun? <a href="<?php echo base_url('register') ?>" style="color: blue">Daftar sekarang</a></div>
          <a href="<?php echo base_url('/') ?>" class="btn bg-danger text-white">Kembali</a>
          <button type="submit" class="btn bg-dark text-white">Masuk</button>
        </div>
      </div>
    </form>
    </center>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>