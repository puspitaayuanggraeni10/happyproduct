    </div>
  </section>
</div>

<footer class="main-footer text-sm">
  <strong>Happy Puppy Test</strong>
</footer>

</div>

<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>

<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
