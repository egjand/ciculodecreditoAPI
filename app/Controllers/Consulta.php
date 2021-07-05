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
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://services.circulodecredito.com.mx/sandbox/v2/rcc',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            $data["rfc"],
            $data["primer_nombre"],
            $data["segundo_nombre"],
            $data["apellido_paterno"],
            $data["apellido_materno"],
            $data["sexo"],
            $data["estado_civil"],
            $data["fecha_nacimiento"],
            $data["calle"],
            $data["numero_exterior"],
            $data["numero_interior"],
            $data["codigo_postal",],
            $data["telefono_cel"],
            $data["colonia"],
            $data["municipio"],
            $data["ciudad"],
            $data["estado"]
          }
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'x-api-key: 5rGqQ93CxD2APeVXeO3K3D2tUDGNSPjQ',
            'Cookie: incap_ses_1061_2077528=/v01MiJ38kJ7MiWxUG65Donm3GAAAAAAUa5/GWGrbAMpDvIV1sEbQw==; nlbi_2077528=U167A6E9DQQI4XBpGp8RlAAAAABxJIqkR/xRfQGVzn6IckIt; visid_incap_1979802=y79ki+1uSnaNjwsGDBGWXZlKuWAAAAAAQUIPAAAAAACPwa4uJwQdJSqC5/TImSvm; visid_incap_2077528=P0Zx+wrzTu+rETU2tNMeYuNLuWAAAAAAQUIPAAAAAADhs1iOoheF8mpRUSXRMUsg'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
        
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
