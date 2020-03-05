<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all()
    {
        $this->db->select('p.*,k.*');
        $this->db->from('produk p');
        $this->db->join('kategori k', 'p.id_kat = k.id_kat', 'INNER');
        $this->db->order_by('p.nm_prod', 'desc');
        return $this->db->get();
    }
    public function insert($data)
    {
        $this->db->insert('produk', $data);
        return TRUE;
    }
    public function update($data)
    {
        $this->db->where(array('id_prod' => $data['id_prod']));
        $this->db->update('produk', $data);
        return TRUE;
    }
    public function delete($id)
    {
        $this->db->where('id_prod', $id);
        $this->db->delete('produk');
    }
    /*Categories*/
    public function get_categories()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        return $this->db->get();
    }
}
