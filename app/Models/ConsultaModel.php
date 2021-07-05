<?php
namespace App\Models;
use CodeIgniter\Model;

class ConsultaModel extends model 
{
    protected $table = 'circulodecredito';
    protected $primaryKey = 'id';
    protected $allowedFields = ['primer_nombre', 'segundo_nombre', 'apellido_paterno', 'apellido_materno', 'sexo',
                                'estado_civil', 'fecha_nacimiento', 'calle', 'numero_exterior', 'numero_interior',
                                'codigo_postal', 'telefono_cel', 'colonia', 'municipio', 'ciudad', 'estado', 'rfc', 'termino_condicion',
                                'autorizo', 'folioConsulta', 'folioConsultaOtorgante', 'claveOtorgante'];


}