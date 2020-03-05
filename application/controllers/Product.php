<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('product_m'));
  }
  public function index()
  {
    $this->data['title'] = 'Product';
    $this->load->view('product/data', $this->data);
  }
  public function get_all()
  {
    $product = $this->product_m->get_all()->result_array();
    $this->output->set_content_type('application/json')->set_output(json_encode($product));
  }
  public function insert()
  {
    $postdata = json_decode(file_get_contents('php://input'), TRUE);
    if (isset($postdata['produk'])) {
      $kode = (isset($postdata['produk']['kd_prod']) ? $postdata['produk']['kd_prod'] : NULL);
      $nm_prod = (isset($postdata['produk']['nm_prod']) ? $postdata['produk']['nm_prod'] : NULL);
      $id_kat = (isset($postdata['produk']['id_kat']) ? $postdata['produk']['id_kat'] : NULL);
      $harga = (isset($postdata['produk']['harga']) ? $postdata['produk']['harga'] : NULL);
      $stok = (isset($postdata['produk']['stok']) ? $postdata['produk']['stok'] : NULL);
      if ($kode == NULL) {
        http_response_code(400);
        $this->output->set_content_type('application/json')->set_output(json_encode(['errors' => ["Name Field is required"]]));
      } else {
        $data = array(
          'kd_prod' => $kode,
          'nm_prod' => $nm_prod,
          'id_kat' => $id_kat,
          'harga' => $harga,
          'stok' => $stok
        );
        $this->product_m->insert($data);
      }
    }
  }
  public function update()
  {
    $postdata = json_decode(file_get_contents('php://input'), TRUE);
    if (isset($postdata['produk'])) {
      $kode = (isset($postdata['produk']['kd_prod']) ? $postdata['produk']['kd_prod'] : NULL);
      $nm_prod = (isset($postdata['produk']['nm_prod']) ? $postdata['produk']['nm_prod'] : NULL);
      $id_kat = (isset($postdata['produk']['id_kat']) ? $postdata['produk']['id_kat'] : NULL);
      $harga = (isset($postdata['produk']['harga']) ? $postdata['produk']['harga'] : NULL);
      $stok = (isset($postdata['produk']['stok']) ? $postdata['produk']['stok'] : NULL);
      $id_prod = (isset($postdata['produk']['id_prod']) ? $postdata['produk']['id_prod'] : NULL);
      if ($kode == NULL) {
        http_response_code(400);
        $this->output->set_content_type('application/json')->set_output(json_encode(['errors' => ["Name Field is required"]]));
      } else {
        $data = array(
          'kd_prod' => $kode,
          'nm_prod' => $nm_prod,
          'id_kat' => $id_kat,
          'harga' => $harga,
          'stok' => $stok,
          'id_prod' => $id_prod
        );
        $this->product_m->update($data);
      }
    }
  }
  public function delete()
  {
    $postdata = json_decode(file_get_contents("php://input"));
    if (isset($postdata) && !empty($postdata)) {
      $id = (int) $postdata->ID;
      $this->product_m->delete($id);
    }
  }
  public function get_category()
  {
    $category = $this->product_m->get_categories()->result_array();
    $this->output->set_content_type('application/json')->set_output(json_encode($category));
  }
  // 
}
