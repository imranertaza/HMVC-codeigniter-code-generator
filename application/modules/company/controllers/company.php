<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Company_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'company/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'company/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'company/index.html';
            $config['first_url'] = base_url() . 'company/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Company_model->total_rows($q);
        $company = $this->Company_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'company_data' => $company,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('company/company_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->Company_model->get_by_id($id);
        if ($row) {
            $data = array(
		'com_id' => $row->com_id,
		'name' => $row->name,
		'contact_number' => $row->contact_number,
		'date_time' => $row->date_time,
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('company/company_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('company'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('company/create_action'),
	    'com_id' => set_value('com_id'),
	    'name' => set_value('name'),
	    'contact_number' => set_value('contact_number'),
	    'date_time' => set_value('date_time'),
	);
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('company/company_form', $data);
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
		'contact_number' => $this->input->post('contact_number',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Company_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('company'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Company_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('company/update_action'),
		'com_id' => set_value('com_id', $row->com_id),
		'name' => set_value('name', $row->name),
		'contact_number' => set_value('contact_number', $row->contact_number),
		'date_time' => set_value('date_time', $row->date_time),
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('company/company_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('company'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('com_id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'contact_number' => $this->input->post('contact_number',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Company_model->update($this->input->post('com_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('company'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Company_model->get_by_id($id);

        if ($row) {
            $this->Company_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('company'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('company'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('contact_number', 'contact number', 'trim|required');
	$this->form_validation->set_rules('date_time', 'date time', 'trim|required');

	$this->form_validation->set_rules('com_id', 'com_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "company.xls";
        $judul = "company";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Contact Number");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Time");

	foreach ($this->Company_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->contact_number);
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
        header("Content-Disposition: attachment;Filename=company.doc");

        $data = array(
            'company_data' => $this->Company_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('company/company_doc',$data);
    }

}

/* End of file Company.php */
/* Location: ./application/controllers/Company.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-27 11:17:48 */
/* http://harviacode.com */