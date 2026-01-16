<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

  private $table = 'products';
  private $column_search = ['products.name', 'categories.name'];
  private $order = ['products.id' => 'DESC'];

  private function _query($category_id = null)
  {
    $this->db->select('products.*, categories.name AS category_name');
    $this->db->from($this->table);
    $this->db->join('categories', 'categories.id = products.category_id', 'left');

    if (!empty($category_id)) {
      $this->db->where('products.category_id', (int)$category_id);
    }

    $search_value = $this->input->post('search')['value'] ?? null;
    if (!empty($search_value)) {
      $this->db->group_start();
      foreach ($this->column_search as $i => $item) {
        if ($i === 0) $this->db->like($item, $search_value);
        else $this->db->or_like($item, $search_value);
      }
      $this->db->group_end();
    }

    if ($this->input->post('order')) {
      $order = $this->input->post('order')[0];
      $columns = ['products.id','products.name','categories.name','products.price','products.stock',null];

      $col_index = (int)$order['column'];
      $dir = $order['dir'];

      if (isset($columns[$col_index]) && $columns[$col_index] !== null) {
        $this->db->order_by($columns[$col_index], $dir);
      }
    } else {
      $this->db->order_by(key($this->order), $this->order[key($this->order)]);
    }
  }

  public function get_datatables($category_id = null)
  {
    $this->_query($category_id);
    $length = (int)$this->input->post('length');
    $start  = (int)$this->input->post('start');
    if ($length != -1) $this->db->limit($length, $start);
    return $this->db->get()->result();
  }

  public function count_filtered($category_id = null)
  {
    $this->_query($category_id);
    return $this->db->get()->num_rows();
  }

  public function count_all()
  {
    return $this->db->count_all($this->table);
  }

  /**
   * Format single row untuk DataTables response
   */
  public function format_datatables_row($product)
  {
    return [
      "IDB".$product->id,
      html_escape($product->name),
      '<span class="badge badge-info">'.html_escape($product->category_name).'</span>',
      number_format($product->price),
      $product->stock,
      $this->get_action_buttons($product->id)
    ];
  }

  /**
   * Generate HTML action buttons (edit & delete)
   */
  private function get_action_buttons($product_id)
  {
    return '
    <div class="btn-group btn-group-sm">
      <button type="button" class="btn btn-info btn-sm" onclick="openEditModal('.$product_id.')">
        <i class="fas fa-edit"></i>
      </button>
      <button type="button" class="btn btn-danger btn-sm" onclick="deleteProduct('.$product_id.')">
        <i class="fas fa-trash"></i>
      </button>
    </div>
    ';
  }
}
