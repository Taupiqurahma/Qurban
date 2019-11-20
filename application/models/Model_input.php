<?php
defined('BASEPATH') or exit ('No Direct Script Access Allowed');

class Model_input extends CI_Model{

	  public function __construct()
    {
        $this->load->database();
    }
    private $table = "penerima";


  private function kode_otomatis(){
        $this->db->select('right(id,3) as kode', false);
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query=$this->db->get('penerima');
        if($query->num_rows()<>0){
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }

        $kodemax=str_pad($kode,3,"0", STR_PAD_LEFT);
        $kodejadi='PQRBN-AMJ'.$kodemax;

        return $kodejadi;
    }


public function createdata()
    {
       $data = array 
       (
           'id' => ($this->kode_otomatis()),
           'keterangan' => $this->input->post('keterangan'),
           'waktu' => $this->input->post('waktu'),
           'tempat' => $this->input->post('tempat'),
       );

       $this->db->insert('penerima', $data);
   }

    function json_data_penerima(){
        $this->datatables->select('id,'
            .'penerima.id as  id,'
            .'penerima.status as  status,'
        );
        $this->datatables->from('penerima');
        $this->datatables->add_column('view1','<a href="'. base_url('C_dashboard/valid/$1').'"><button class="btn btn-sm btn-success fa fa-edit"   >Update</button></a>','id');
        return $this->datatables->generate();	
    }
public	function update($where,$table)
{
	 $id= $this->input->post('id');
      $status = $this->input->post('status');
	$this->db->set('status','Sudah Diterima');
  $this->db->where($where);
  $this->db->update($table);
}

public function jumlahPenerimaan(){
    $this->db->select("count(status) as status");
    $this->db->from($this->table);
    $this->db->where('status',"Belum Diterima");
    return $this->db->get()->row()->status;
}

public function jumlahPenyerahan(){
    $this->db->select("count(status) as status");
    $this->db->from($this->table);
    $this->db->where('status',"Sudah Diterima");
    return $this->db->get()->row()->status;
}

}