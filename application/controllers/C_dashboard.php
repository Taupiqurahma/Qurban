<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {
	function __construct(){
    parent::__construct();
    $this->load->library('Datatables');
    $this->load->library('Pdf');
    $this->load->model('Model_input');
     if ($this->session->userdata('akses')=='1') {
      redirect(base_url(''));
    }
    elseif ($this->session->userdata('masuk')!= TRUE) {
     redirect(base_url('Admin'));
   }
 
   
 }
	public function index()
  
	{

	$data["jumlahPenerimaan"] = $this->Model_input->jumlahPenerimaan();
      $data["jumlahPenyerahan"] = $this->Model_input->jumlahPenyerahan();
    
		$this->load->view('template/header',$data);
		$this->load->view('V_home');
		$this->load->view('template/footer');
	}

	public function input()
	{
		$this->load->view('template/header');
		$this->load->view('V_input');
		$this->load->view('template/footer');

	}

	public function penerima()
	{
		$this->load->view('template/header');
		$this->load->view('V_listpenerima');
	

	}

	public function simpan()
	{

		$this->Model_input->createdata();
		redirect(site_url('C_dashboard/input'));
	}

	public function json_data_penerima()
	{ 
		$query = $this->Model_input->json_data_penerima();
		echo $query;
	}

	

function valid($id)
{
  $where = array('id' => $id);
  $this->Model_input->update($where,'penerima');
  redirect('C_dashboard/penerima');
}

public function export()
{
  $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
  $pdf->AddPage();
        // setting jenis font yang akan digunakan
  $pdf->SetFont('Arial','B',16);
        // mencetak string
  $pdf->Image('assets/img/12.jpg') ;
  $pdf->Cell(250,7, 'LAPORAN KESELURUHAN',0,1,'C');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(250,7,'DAFTAR PENERIMA QURBAN 2019/1440H',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
  $pdf->Cell(10,7,'',0,1);
  
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(50,6,'ID PENERIMAAN',1,0);
  $pdf->Cell(70,6,'STATUS PENERIMAAN',1,0);
  $pdf->Cell(60,6,'KETERANGAN',1,0);
  $pdf->Cell(90,6,'WAKTU',1,1);
 
  $pdf->SetFont('Arial','',10);
  $peserta = $this->db->get('penerima')->result();
  foreach ($peserta as $row){
    $pdf->Cell(50,6,$row->id,1,0);
    $pdf->Cell(70,6,$row->status,1,0);
    $pdf->Cell(60,6,$row->keterangan,1,0);
    $pdf->Cell(90,6,$row->waktu,1,1);
  }
  $pdf->Output();
}

}