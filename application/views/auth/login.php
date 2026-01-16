<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css'); ?>">
  <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <b>Admin</b> Login
    </div>

    <div class="card-body">
      <p class="login-box-msg">Silakan login</p>

      <form action="<?= base_url('auth/login'); ?>" method="post">
        <div class="input-group mb-3">
          <input name="username" type="text" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <button class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </div>
</div>
<!-- start toast -->
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end', // pojok kanan atas
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
  });

  function showToast(type, message) {
    Toast.fire({
      icon: type,
      title: message
    });
  }
</script>

<?php $toast = $this->session->flashdata('toast'); ?>
<?php if (!empty($toast) && !empty($toast['type']) && !empty($toast['message'])): ?>
<script>
  showToast("<?= $toast['type']; ?>", "<?= addslashes($toast['message']); ?>");
</script>
<?php endif; ?>
<!-- end toast -->


</body>
</html>
