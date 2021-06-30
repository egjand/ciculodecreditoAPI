<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	public $consultaValidation = [
		'primer_nombre' => 'required',
		'segundo_nombre' => 'permit_empty',
		'apellido_paterno' => 'required',
		'apellido_materno' => 'required',
		'sexo' => 'required',
		'estado_civil' => 'required',
		'fecha_nacimiento' => 'required|valid_date[Y/m/d]',
		'calle' => 'required',
		'numero_exterior' => 'permit_empty',
		'numero_interior' => 'permit_empty',
		'codigo_postal' => 'required|integer|max_length[5]|min_length[5]',
		'telefono_cel' => 'required|max_length[10]|min_length[10]|integer',
		'colonia' => 'required',
		'municipio' => 'required',
		'ciudad' => 'required',
		'estado' => 'required'
	];
	public $consultaValidation_errors = [
		'primer_nombre' => [
			'required' => 'primer nombre obligatorio',
		],
		'apellido_paterno' => [
			'required' => 'apellido paterno obligatorio'
		],
		'apellido_materno' => [
			'required' => 'apellido materno obligatorio'
		],
		'sexo' => [
			'required' => 'seleccione su sexo entre masculino o femenino',

		],
		'estado_civil' =>[
			'required' => 'seleccione su estado civil'
		],
		'fecha_nacimiento' => [
			'required' => 'año de nacimiento obligatorio',
			'valid_date' => 'formato de fecha debe ser año/mes/dia'
		],
		'calle' => [
			'required' => 'escriba el nombre de su calle'
		],
		'codigo_postal' => [
			'required' => 'escribe el codigo postal',
			'integer' => 'el codigo postal tiene que ser numerico',
			'max_length' => 'no tiene que sobrepasar los 5 digitos',
			'min_length' => 'no tiene que ser menor a 5 digitos'
		],
		'telefono_cel' => [
			'required' => 'telefono celular obligatorio',
			'max_length' => 'no tiene que sobrepasar los 10 digitos',
			'min_length' => 'no tiene que ser menor a 10 digitos',
			'integer' => 'el telefono tiene que ser numerico',
		],
		'colonia' => [
			'required' => 'escribe el nombre de tu colonia'
		],
		'municipio' => [
			'required' => 'escribe el nombre de tu municipio'
		],
		'ciudad' => [
			'required' => 'escribe el nombre de tu ciudad'
		],
		'estado' => [
			'required' => 'escribe el nombre de tu estado'
		]
		
	];


	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
