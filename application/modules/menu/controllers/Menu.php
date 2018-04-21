<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Menu_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'menu/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'menu/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'menu/index.html';
            $config['first_url'] = base_url() . 'menu/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Menu_model->total_rows($q);
        $menu = $this->Menu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'menu_data' => $menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('menu/menu_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->Menu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'menu_id' => $row->menu_id,
		'icon' => $row->icon,
		'name_menu' => $row->name_menu,
		'link' => $row->link,
		'parent' => $row->parent,
		'position' => $row->position,
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('menu/menu_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu/create_action'),
	    'menu_id' => set_value('menu_id'),
	    'icon' => set_value('icon'),
	    'name_menu' => set_value('name_menu'),
	    'link' => set_value('link'),
	    'parent' => set_value('parent'),
	    'position' => set_value('position'),
	);
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('menu/menu_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'icon' => $this->input->post('icon',TRUE),
		'name_menu' => $this->input->post('name_menu',TRUE),
		'link' => $this->input->post('link',TRUE),
		'parent' => $this->input->post('parent',TRUE),
		'position' => $this->input->post('position',TRUE),
	    );

            $this->Menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu/update_action'),
		'menu_id' => set_value('menu_id', $row->menu_id),
		'icon' => set_value('icon', $row->icon),
		'name_menu' => set_value('name_menu', $row->name_menu),
		'link' => set_value('link', $row->link),
		'parent' => set_value('parent', $row->parent),
		'position' => set_value('position', $row->position),
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('menu/menu_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('menu_id', TRUE));
        } else {
            $data = array(
		'icon' => $this->input->post('icon',TRUE),
		'name_menu' => $this->input->post('name_menu',TRUE),
		'link' => $this->input->post('link',TRUE),
		'parent' => $this->input->post('parent',TRUE),
		'position' => $this->input->post('position',TRUE),
	    );

            $this->Menu_model->update($this->input->post('menu_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $this->Menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('name_menu', 'name menu', 'trim|required');
	$this->form_validation->set_rules('link', 'link', 'trim|required');
	$this->form_validation->set_rules('parent', 'parent', 'trim|required');
	$this->form_validation->set_rules('position', 'position', 'trim|required');

	$this->form_validation->set_rules('menu_id', 'menu_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "menu.xls";
        $judul = "menu";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Icon");
	xlsWriteLabel($tablehead, $kolomhead++, "Name Menu");
	xlsWriteLabel($tablehead, $kolomhead++, "Link");
	xlsWriteLabel($tablehead, $kolomhead++, "Parent");
	xlsWriteLabel($tablehead, $kolomhead++, "Position");

	foreach ($this->Menu_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->icon);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name_menu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->link);
	    xlsWriteNumber($tablebody, $kolombody++, $data->parent);
	    xlsWriteNumber($tablebody, $kolombody++, $data->position);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=menu.doc");

        $data = array(
            'menu_data' => $this->Menu_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('menu/menu_doc',$data);
    }

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-27 11:17:33 */
/* http://harviacode.com */