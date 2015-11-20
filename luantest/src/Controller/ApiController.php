<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Api Controller
 *
 * @property \App\Model\Table\ApiTable $Api
 */
class ApiController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('api', $this->paginate($this->Api));
        $this->set('_serialize', ['api']);
    }

    
}
