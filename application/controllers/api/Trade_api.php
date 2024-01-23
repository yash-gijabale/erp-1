<?php
require(APPPATH . 'libraries/RestController.php');

require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Trade_api extends RestController
{


    function __construct()
    {

        parent::__construct();

        error_reporting(0);

        ini_set('display_errors', 0);
        $this->load->model('Comman_model');

    }


    public function allTradeGroup_get()
    {
        $data = $this->Comman_model->get_data('*','trade_gruop');
        $this->response($data, RestController::HTTP_OK);
    }

    public function allTrades_get()
    {
        $data = $this->Comman_model->get_data('*','trade');
        $this->response($data, RestController::HTTP_OK);
    }

}
