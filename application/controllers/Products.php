<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Product_model','product');
    $this->load->model('Category_model','category');
  }

  private function _json($status, $message, $data = null)
  {
      return $this->output->set_content_type('application/json')
          ->set_output(json_encode([
              'status' => $status,
              'message' => $message,
              'data' => $data
          ]));
  }

  public function index()
  {
    $data['title'] = 'Products - '.password_hash('admin', PASSWORD_BCRYPT);;
    $data['categories'] = $this->category->all();
    // echo password_hash('admin', PASSWORD_BCRYPT);

    load_view($this, 'products/index',$data);
  }

  public function ajax_list()
  {
    $category_id = $this->input->post('category_id', true);
    $list = $this->product->get_datatables($category_id);

    $data = [];
    foreach ($list as $p) {
      $data[] = $this->product->format_datatables_row($p);
    }

    $output = [
      "draw" => (int)$this->input->post('draw'),
      "recordsTotal" => $this->product->count_all(),
      "recordsFiltered" => $this->product->count_filtered($category_id),
      "data" => $data,
    ];

    return $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($output));
  }

  public function ajax_update_field()
  {
    $id    = (int)$this->input->post('id');
    $field = $this->input->post('field', true);
    $value = $this->input->post('value', true);

    $allowed = ['price','stock'];
    if(!in_array($field, $allowed)){
      return $this->output->set_content_type('application/json')
        ->set_output(json_encode(['status'=>false,'message'=>'Field tidak valid']));
    }

    if(!is_numeric($value) || $value < 0){
      return $this->output->set_content_type('application/json')
        ->set_output(json_encode(['status'=>false,'message'=>'Value harus angka >= 0']));
    }

    $ok = $this->db->where('id',$id)->update('products', [
      $field => (int)$value
    ]);

    return $this->output->set_content_type('application/json')
      ->set_output(json_encode(['status'=>$ok ? true : false]));
  }

  public function ajax_get($id)
  {
      $id = (int)$id;

      $product = $this->db->select('id,name,category_id,price,stock')
                          ->where('id', $id)
                          ->get('products')
                          ->row();

      if (!$product) {
          return $this->output->set_content_type('application/json')
              ->set_output(json_encode([
                  'status' => false,
                  'message' => 'Produk tidak ditemukan'
              ]));
      }

      return $this->output->set_content_type('application/json')
          ->set_output(json_encode([
              'status' => true,
              'data' => $product
          ]));
  }

public function ajax_save()
{
    $id = (int)$this->input->post('id');

    $name        = $this->input->post('name', true);
    $category_id = (int)$this->input->post('category_id');
    $price       = $this->input->post('price');
    $stock       = $this->input->post('stock');

    // VALIDASI
    if (empty($name) || strlen($name) < 3) {
        return $this->_json(false, 'Nama wajib minimal 3 karakter');
    }
    if (empty($category_id)) {
        return $this->_json(false, 'Kategori wajib dipilih');
    }
    if (!is_numeric($price) || $price < 0) {
        return $this->_json(false, 'Harga harus angka >= 0');
    }
    if (!is_numeric($stock) || $stock < 0) {
        return $this->_json(false, 'Stok harus angka >= 0');
    }

    // cek kategori valid
    $cek_kategori = $this->db->where('id', $category_id)->get('categories')->row();
    if (!$cek_kategori) {
        return $this->_json(false, 'Kategori tidak valid');
    }

    $payload = [
        'name' => $name,
        'category_id' => $category_id,
        'price' => (int)$price,
        'stock' => (int)$stock,
    ];

    if ($id > 0) {
        $ok = $this->db->where('id', $id)->update('products', $payload);
        return $this->_json($ok ? true : false, $ok ? 'Produk berhasil diupdate' : 'Gagal update produk');
    } else {
        $ok = $this->db->insert('products', $payload);
        return $this->_json($ok ? true : false, $ok ? 'Produk berhasil ditambahkan' : 'Gagal tambah produk');
    }
}

public function ajax_delete($id)
{
    $id = (int)$id;

    $product = $this->db->where('id', $id)->get('products')->row();
    if (!$product) return $this->_json(false, 'Produk tidak ditemukan');

    $ok = $this->db->where('id', $id)->delete('products');
    return $this->_json($ok ? true : false, $ok ? 'Produk berhasil dihapus' : 'Gagal hapus produk');
}

}
