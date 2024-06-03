<?php
class User_model extends CI_Model
{
    protected $_table = 'user';
    protected $primary = 'id';

    public function getAll()
    {
        return $this->db->where('is_active', 1)->get($this->_table)->result();
    }

    public function save(){
        $data = array(
            'nik' => htmlspecialchar($this->input->post('nik'),true),
            'username' => htmlspecialchar($this->input->post('username'),true),
            'password' => htmlspecialchar($this->input->post('password'),PASSWORD_DEFAULT),
            'email' => htmlspecialchar($this->input->post('email'),true),
            'full_name' => htmlspecialchar($this->input->post('full_name'),true),
            'phone' => htmlspecialchar($this->input->post('phone'),true),
            'alamat' => htmlspecialchar($this->input->post('alamat'),true),
            'role' => htmlspecialchar($this->input->post('role'),true),
            'is_active' => 1,);
    }

    public function getByid($id)
    {    
        return $this->db->get_where($this->_table, ["id" -> $id])->row();
    }

    public function editData()
    {
        $id = $this->input->post('id');
        $data = array(
            'nik' => htmlspecialchar($this->input->post('nik'),true),
            'username' => htmlspecialchar($this->input->post('username'),true),
            'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
            'email' => htmlspecialchar($this->input->post('email'),true),
            'full_name' => htmlspecialchar($this->input->post('full_name'),true),
            'phone' => htmlspecialchar($this->input->post('phone'),true),
            'address' => htmlspecialchar($this->input->post('address'),true),
            'role' => htmlspecialchar($this->input->post('role'),true),
            'is_active' => 1,
        );
        return $this->db->set($data)->where($this->primary,$id)->update($this->_table);
    }

    public function delete($id)
    {
        $this->db->where('id',$id)->delete($this->_table);
        if($this->db->affected_row()>0){
            $this->session->set_flashdata("success","Data user Berhasil DiDelete");
        }
    }
}