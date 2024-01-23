<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MaterialManegement extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        error_reporting(0);

        ini_set('display_errors', 0);
        $this->load->model('Comman_model');
        $this->load->library('upload');

    }


    public function add_configuration()
    {
        $data['_view'] = 'material/material_configuration';
        $this->load->view('template/view', $data);
    }

    public function add_measurement()
    {
        $postData = $this->input->post();
        $mesures = explode(',',$postData['measurement_name']);
        // echo'<pre>';print_r($mesures);exit;
        if($mesures)
        {
            foreach($mesures as $mesure)
            {
                $param = array('measure_name' => $mesure);
                $this->Comman_model->insert_data('material_measures',$param);
            }
        }

        $data['_view'] = 'material/material_configuration';
        $this->load->view('template/view', $data);

    }

    public function add_material()
    {
        $postData = $this->input->post();
        if($postData)
        {
            // echo'<pre>';print_r($postData);exit;
            $param = array
            (
                'developer_id' => $postData['developer_id'],
                'project_id' => $postData['project_id'],
                'material_name'=> $postData['material_name'],
                'material_quantity' => $postData['material_qty'],
                'material_price' => $postData['unit_price'],
                'total_amount' => $postData['total_amount'],
                'material_type' => $postData['material_type'],
                'material_unit' => $postData['material_unit'],
            );
            $res = $this->Comman_model->insert_data('total_material', $param);

        }
        $data['all_developers'] = $this->Comman_model->get_data('*','developer');
        $data['measures'] = $this->Comman_model->get_data('*', 'material_measures');
        $data['_view'] = 'material/add_material';
        $this->load->view('template/view', $data);

    }

    public function material_list()
    {
        $postData = $this->input->post();
        if($postData)
        {
            $data['material_list'] = $this->Comman_model->get_data('*', 'total_material', array('project_id' => $postData['project_id']));
            $data['selected_project'] = $postData['project_id'];

        }else{

            $data['material_list'] = $this->Comman_model->get_data('*', 'total_material');
            $data['selected_project'] = $postData['project_id'];
        }

        $data['_view'] = 'material/material_list';
        $this->load->view('template/view', $data);
    }

    public function supply_material()
    {
        $postData = $this->input->post();
        if($postData){
            // echo'<pre>';print_r($postData);exit;
            $param = array(
                'developer_id' => $postData['developer_id'],
                'project_id' => $postData['project_id'],
                'material_id' => $postData['material_id'],
                'material_qauntity' => $postData['material_qty'],
                'total_amount' => $postData['total_amount']
            );
            $material = $this->Comman_model->get_data_by_id('*', 'total_material', array('material_id'=> $postData['material_id']));
            if($material)
            {
                $material_param = array
                (
                    'material_quantity' => $material->material_quantity - $postData['material_qty'],
                    'total_amount' => $material->total_amount - $postData['total_amount'],
                );
                $this->Comman_model->update_data('total_material', $material_param, array('material_id'=> $postData['material_id']));
                $this->Comman_model->insert_data('supplied_material', $param);
            }
            
        }
        $data['material_list'] = $this->Comman_model->get_data('*', 'total_material');
        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        $data['_view'] = 'material/supply_material';
        $this->load->view('template/view', $data);
    }

    public function get_material_data()
    {
        $postData = $this->input->post('material_id');
        $material = $this->Comman_model->get_data_by_id('*', 'total_material', array('material_id'=> $postData));
        if($material){
            echo json_encode($material);
        }
    }

    public function supply_list()
    {
        $data['supply_list'] = $this->Comman_model->get_data('*', 'supplied_material');
        $data['_view'] = 'material/supply_list';
        $this->load->view('template/view', $data);
    }

    public function get_material_by_dev_and_project_id()
    {
        $project_id = $this->input->post('project_id');
        $developer_id = $this->input->post('developer_id');
        $materials = $this->Comman_model->get_data('*', 'total_material', array('developer_id'=> $developer_id, 'project_id' => $project_id));
        echo json_encode($materials);

    }
    
}

?>