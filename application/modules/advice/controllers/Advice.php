<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Advice_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'advice/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'advice/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'advice/index.html';
            $config['first_url'] = base_url() . 'advice/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Advice_model->total_rows($q);
        $advice = $this->Advice_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'advice_data' => $advice,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('advice/advice_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->Advice_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ad_id' => $row->ad_id,
		'name' => $row->name,
		'date_time' => $row->date_time,
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('advice/advice_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('advice'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('advice/create_action'),
	    'ad_id' => set_value('ad_id'),
	    'name' => set_value('name'),
	    'date_time' => set_value('date_time'),
	);
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('advice/advice_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Advice_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('advice'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Advice_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('advice/update_action'),
		'ad_id' => set_value('ad_id', $row->ad_id),
		'name' => set_value('name', $row->name),
		'date_time' => set_value('date_time', $row->date_time),
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('advice/advice_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('advice'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ad_id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Advice_model->update($this->input->post('ad_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('advice'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Advice_model->get_by_id($id);

        if ($row) {
            $this->Advice_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('advice'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('advice'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('date_time', 'date time', 'trim|required');

	$this->form_validation->set_rules('ad_id', 'ad_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "advice.xls";
        $judul = "advice";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Time");

	foreach ($this->Advice_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_time);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=advice.doc");

        $data = array(
            'advice_data' => $this->Advice_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('advice/advice_doc',$data);
    }

}

/* End of file Advice.php */
/* Location: ./application/controllers/Advice.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-27 11:17:42 */
/* http://harviacode.com */