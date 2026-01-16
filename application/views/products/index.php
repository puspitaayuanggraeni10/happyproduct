<div class="row">
  <div class="col-12">

    <div class="card card-primary card-outline">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center w-100">
        <h3 class="card-title m-0">
          <i class="fas fa-box"></i> <?= $title;?>
        </h3>

        <button type="button" class="btn btn-primary btn-sm ml-auto" onclick="openCreateModal()">
          <i class="fas fa-plus-circle"></i> Tambah Produk
        </button>
      </div>
    </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3">
            <select id="filterKategori" class="form-control">
              <option value="">Semua Kategori</option>
              <?php foreach($categories as $c): ?>
                <option value="<?= $c->id; ?>"><?= html_escape($c->name); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="table-responsive">
          <table id="tblProducts" class="table table-hover">
            <thead class="bg-light">
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
          <!-- MODAL _form -->
          <div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
                  <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                  </button>
                </div>

                <form id="formProduct">
                  <div class="modal-body">

                    <input type="hidden" name="id" id="prod_id">

                    <div class="form-group">
                      <label>Nama Produk</label>
                      <input type="text" name="name" id="prod_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="category_id" id="prod_category_id" class="form-control" required>
                        <option value="">-- pilih --</option>
                        <?php foreach($categories as $c): ?>
                          <option value="<?= $c->id; ?>"><?= html_escape($c->name); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Harga</label>
                      <input type="number" min="0" name="price" id="prod_price" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>Stok</label>
                      <input type="number" min="0" name="stock" id="prod_stock" class="form-control" required>
                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">
                      <i class="fas fa-save"></i> Simpan
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</div>

<script>
  var table;

$(function(){

  table = $('#tblProducts').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    lengthMenu: [ [5, 10], [5, 10] ],
    pageLength: 5,

    ajax: {
      url: "<?= base_url('products/ajax_list'); ?>",
      type: "POST",
      data: function(d){
        d.category_id = $('#filterKategori').val();
      }
    },
    order: [[0,'desc']],
    columnDefs: [
      { targets: [5], orderable: false }
    ],

    initComplete: function () {
      let filterBox = $('#tblProducts_filter');

      // pindahkan dropdown ke samping search
      $('#filterKategori')
        .removeClass('d-none')
        .addClass('ml-2 form-control form-control-sm')
        .css({
          'display': 'inline-block',
          'width': '200px' // lebar dropdown
        })
        .appendTo(filterBox);

      // set lebar search input sama
      $('#tblProducts_filter input[type="search"]')
        .addClass('form-control form-control-sm')
        .css({
          'width': '200px', // lebar search
          'display': 'inline-block'
        });
    }

  });


  $('#filterKategori').on('change', function(){
    table.ajax.reload();
  });



// submit modal form (create/update)
  $('#formProduct').on('submit', function(e){
    e.preventDefault();

    $('#btnSave').prop('disabled', true);

    $.ajax({
      url: "<?= base_url('products/ajax_save'); ?>",
      type: "POST",
      dataType: "json",
      data: $(this).serialize(),
      success: function(res){
        $('#btnSave').prop('disabled', false);

        if(res.status){
          $('#modalProduct').modal('hide');
          showToast('success', res.message);
          table.ajax.reload(null, false); // reload tanpa balik page 1
        }else{
          showToast('error', res.message);
        }
      },
      error: function(xhr){
        $('#btnSave').prop('disabled', false);
        console.log(xhr.responseText);
        showToast('error', 'Server error');
      }
    });
  });

});

// OPEN CREATE MODAL
function openCreateModal(){
  $('#modalTitle').text('Tambah Produk');
  $('#btnSave').html('<i class="fas fa-plus-circle"></i> Tambah');
  $('#prod_id').val('');
  $('#prod_name').val('');
  $('#prod_category_id').val('');
  $('#prod_price').val('');
  $('#prod_stock').val('');
  $('#modalProduct').modal('show');
}

// OPEN EDIT MODAL
function openEditModal(id){
  $.ajax({
    url: "<?= base_url('products/ajax_get/'); ?>" + id,
    type: "GET",
    dataType: "json",
    success: function(res){
      if(res.status){
        $('#modalTitle').text('Edit Produk');
        $('#btnSave').html('<i class="fas fa-check-circle"></i> Update');
        $('#prod_id').val(res.data.id);
        $('#prod_name').val(res.data.name);
        $('#prod_category_id').val(res.data.category_id);
        $('#prod_price').val(res.data.price);
        $('#prod_stock').val(res.data.stock);

        $('#modalProduct').modal('show');
      }else{
        showToast('error', res.message);
      }
    }
  });
}

// DELETE AJAX
function deleteProduct(id){
  Swal.fire({
    title: 'Hapus produk?',
    text: 'Data yang dihapus tidak bisa dikembalikan.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus',
    cancelButtonText: 'Batal'
  }).then((result)=>{
    if(result.isConfirmed){
      $.ajax({
        url: "<?= base_url('products/ajax_delete/'); ?>" + id,
        type: "POST",
        dataType: "json",
        success: function(res){
          if(res.status){
            showToast('success', res.message);
            table.ajax.reload(null, false);
          }else{
            showToast('error', res.message);
          }
        }
      });
    }
  });
}

$(document).on('change', '.edit-inline', function(){
  const id = $(this).data('id');
  const stock = $(this).val();
  const field = $(this).data('field');
  $.ajax({
    url: "<?= base_url('products/ajax_update_field'); ?>",
    type: "POST",
    dataType: "json",
    data: {
      id: id,
      field: field,
      value: stock
    },
    success: function(res){
      if(res.status){
        showToast('success', field+' berhasil diupdate');
      } else {
        showToast('error', res.message || 'Gagal update stok');
      }
    }
  });
});

</script>
