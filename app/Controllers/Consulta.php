<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ConsultaModel;


class Consulta extends ResourceController
{
    protected $modelName = 'App\Models\BooksModel';
    protected $format    = 'json';
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new ConsultaModel();
        $data = $model->findAll();
       
        if (!empty($data)) {
            $respuesta = [
                'status' => 200,
                'message' => "los datos han sido cargados",
                'data' => ([
                    'count' => count($data),
                    'data' => $data,
                ]),
            ];
            return $this->respond($respuesta);
        } else {

            return $this->failNotFound('la base de datos se encuentra vacia');
        }
    }

    // get single product
    public function show($id = null)
    {
        $model = new ConsultaModel();
        $uri = new \CodeIgniter\HTTP\URI();
        $uri = current_url(true);
        $id = (int)$uri->getSegment(2);
        $data = $model->getWhere(['id' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('no se encontro el id: ' . $id);
        }
    }

    // create a product
    public function create()
    {
        $model = new ConsultaModel();
        $data = $this->request->getRawInput();
        $validation =  \Config\Services::validation();

        if ($validation->run($data, 'consultaValidation')) {

            $model->insert($data);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Guardado correctamente', $data
                ]
            ];
            return $this->respondCreated($response);
        }else{
          
            $this->failNotFound('ingrese sus datos correctamente');
        }
        $errors = $validation->getErrors();
        return $this->respond($errors, 400);
        
    }



    public function update($id = null)
    {
        $model = new ConsultaModel();
        $uri = new \CodeIgniter\HTTP\URI();
        $uri = current_url(true);
        $id = (int)$uri->getSegment(2);
        $data = $model->getWhere(['id' => $id])->getResult();

        if (!empty($data)) {
            $input = $this->request->getRawInput();
            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'usuario actualizado correctamente',
                'resultado' => $input
            );
            $model->update($id, $input);
            return $this->respondCreated($respuesta);
        } else {

            return $this->failNotFound('el id ' . $id . ' no existe');
        }
    }

    // delete product
    public function delete($id = null)
    {
        $model = new ConsultaModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}
