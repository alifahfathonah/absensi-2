<?php

class Qr extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUsers');
        $this->load->model('ModelQr');
    }

    public function index()
    {
        $id_pegawai = $this->input->post('id_pegawai');
        if ($id_pegawai != null) {
            $date = date('Y-m-d');
            $cekDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($id_pegawai);
            if($cekDataPegawai != null){
                $no_pegawai = $cekDataPegawai['no_pegawai'];
                $device_id = $cekDataPegawai['device_id'];
                $this->load->library('ciqrcode');
            
                $config['cacheable']    = true; //boolean, the default is true
                $config['cachedir']     = './assets/'; //string, the default is application/cache/
                $config['errorlog']     = './assets/'; //string, the default is application/logs/
                $config['imagedir']     = './assets/image_qr/'; //direktori penyimpanan qr code
                $config['quality']      = true; //boolean, the default is true
                $config['size']         = '1024'; //interger, the default is 1024
                $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                $image_name=$no_pegawai.'_'.$date.'.png'; //buat name dari qr code sesuai dengan nip
     
                $params['data'] = $no_pegawai.'_'.$device_id.'_'.$date; //data yang akan di jadikan QR CODE
                $params['level'] = 'H'; //H=High
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name;
                $this->ciqrcode->initialize($config);
                $this->ciqrcode->generate($params);
                $cekDataQr = $this->ModelQr->getDataQrByDate($id_pegawai,$date);
                if($cekDataQr == null){
                    $insert = array(
                        'id_pegawai'    => $id_pegawai,
                        'date'          => $date,
                        'qr_code'       => $image_name
                    );
                    $this->ModelQr->insertData($insert);
                }
                
                $data['qr_code'] = $this->ModelQr->getDataQrByDate($id_pegawai,$date);

            }else{
                $data['test'] = "";
                $this->session->set_flashdata('icon', 'error');
                $this->session->set_flashdata('text', 'Nomor Pegawai tidak terdaftar di sistem kami !!');
                $this->session->set_flashdata('title', 'Proses QR gagal');
            } 
           

            $this->load->view('dashboard/qr/qrcode',$data);
        } else {

            $this->load->view('dashboard/qr/qrcode');
        }
    }
}
