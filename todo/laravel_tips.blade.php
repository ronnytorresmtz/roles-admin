
<?php

@Laravel Tips

1) MANEJO DE FORM::SELECT CON PERSISTENCIA
2) MANEJO DE SOFTDELETE THE QUERIES CON MULTIPLES WHERE AND WHEREOR



---------------------------------------------------------------------


MANEJO DE FORM:SELECT CON PERSISTENCIA
//	Documentar como manejar la persistencia de un select a través del controller y el helper de laravel Form::Select (revisar el caso de la modulo de Users)


	Ejemplo

	// Cuando se crea la vista donde se va a desplegar el combo se debe de enviar la información en un formato de arreglo 
	// 
		 PASO 1 // CREACION DE LA VISTA HTML
	
			$roles=$this->roleRepository->getAllRoles();  // Se extraen los valores a desplegar en el combo (ID / Texto)

			foreach ($roles as $role ) {
				$roles_names[$role->id] = $role->role_name;  // Se genera el areglo donde el indice es el ID del registro y el valor el Texto.
			}

		  	return View::make($this->directory_files .'/create')
		  		->with(array('roles'=> $roles_names, 'role_name' => 0));    // En una variable se regresa el arreglo 
		  																	// y en otro el valor DEFAULT del combo
		  																	// esta variable DEFAULT se refencia en el HTML (ver paso 3)

		PASO 2  // ALMACENAR DATOS DEL REQUEST EN SESSION PARA TENER PESISTENCIA(SON LOS DATOS DEL INPUT DE LA FORMA)

			public function store(Request $request)  // A la funcion que recibe el POST se debe colocar la parametro de Request
			{
				
				$request->flash();  // Se almacena en session flash los valores del input de la forma / los valores del request.
				....
				.....

		PASO 3  // COLOCAR EL FORM::SELECT REFERENCIANDO A LA VARIABLE DEFAULT

			{!!Form::label(Lang::get('fields.role_name'))!!} //Etiqueta a Desplegar

			{!!Form::select('role_name', $roles, $role_name, array('class'=>'form-control'))!!}  // Se hace referencia al arreglo y variable
																								 // DEFAULT del paso 1


MANEJO DE SOFTDELETE THE QUERIES CON MULTIPLES WHERE AND WHEREOR
//	Cuando se maneja multiples where and whereor el parentesis es muy importante para lo que se debe utilizar una función para meter los whereor

	Ejemplo

		->join('roles', 'users.role_id','=', 'roles.id')
		->where('users.id','like','%' . $value . '%')
		->where(function ($query) use ($value) {
			$query->orwhere('users.username','like','%' . $value . '%');
	 		$query->orwhere('users.user_fullname','like','%' . $value . '%');
	 		$query->orwhere('users.email','like','%' . $value . '%');
	 		$query->orwhere('roles.role_name','like','%'. $value . '%');
		})
		->paginate($itemsByPage);
