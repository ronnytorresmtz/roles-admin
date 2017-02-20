<style scoped></style>
<template></template>

<script>

module.exports = {

  en: { 

      //App <menu>
      appName:            'Roles Admin',
      menuOptions:        'Menu Options',
      dashboard:          'Dashboard',
      modules:            'Modules',
      module:             'Module',
      transactions:       'Transactions',
      transaction:        'Transaction',
      roles:              'Roles',
      role:               'Role',
      users:              'Users',
      user:               'User',
      accessRights:       'Access Rights',
      transactionActions: 'Transaction Actions',
      help:               'Help',
      logout:             'Logout',

      //Dates      
      short_months: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dic'],
      long_months: ['January','Febrary','March','April','May','June','July','August','September','October','November','Dicember'],
      long_week_day: ['Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday'],
      shor_week_day: ['Mon', 'Tue', 'Wed','Thu','Fri','Sat','Sun'],
      
      //General
      id: 'Id',
      status: 'Status',
      createdBy: 'Created By',
      updatedBy: 'Updated By',
      actions: 'Actions',
      links: 'Links',
      info: 'Info',
      active: 'Active',
      inactive: 'Inactive',
      searchFor: 'Search for...',
      processing: 'Procesando',
      new:        'New',

      //Buttons

      add:          'Add',
      edit:         'Edit',
      save:         'Save',
      update:       'Update',
      delete:       'Delete',
      close:        'Close',
      export:       'Export',
      import:       'Import',
      clearFilter:  'Clear Filter',
      send:         'Send',
      reset:        'Reset',
      expand:       'Expand',
      collapse:     'Collapse',
      importFile:   'Import File',

      //Pagination
      start:        'Start',
      prev:         'Prev',
      next:         'Next',
      end:          'End',
      noMorePages:  'No More Pages',
      showing:      'Showwing',
      to:           'to',
      of:           'of',
      items:        'items',

      //*** Login ***
      signIn:                 'Sign In',
      typeTheUsername:        'Type the username',
      typeThePassword:        'Type the password',
      typeTheEmailAddress:    'Type an email address',
      typeTheEmailError:      'Please type a valid email address,',
      rememberMe:             'Remember Me',
      forgotYourPassword:     'Forgot Your Password',
      loginUserDemo:          'Login User Demo',
      getYourPassword:        'Get Your Password,',
      getYourPassMsg:         'Enter the email address associated with your account, then click Send. You will recieve an email with instrucctions to set a new password.',
      resetYourPassword:      'Reset Your Password,',
      securtiyNumberMsg:      'Type the Security Number you received in your email account, then type your New Password, confirm the New Password and Click Reset.',
      securtiyNumber:         'Security Number',
      typeTheSecurityNumber:  'Type the Security Number',
      newPassword:            'New Password',
      typeTheNewPassword:     'Type the New Password',
      newPasswordError:       'Password require 8 characters',
      confirmPassword:        'Confirm Password',
      typeTheConfirmPassword: 'Type the Confirm Password',
      confirmPasswordError:    'Confirm Password does not match',
      

      //*** SECUTIRY ***

      //Users
      userTopMessage:  'This option allows to add, update, active, inactive, import and export the users of the application.',
      userList:        'User List',
      username:        'User Name',
      userFullname:    'User Fullname',
      userEmail:       'User Email',
     
      //Roles
      roleTopMessage:  'This option allows to add, update, active, inactive, import and export the roles of the application.',
      roleList:        'Role List',
      roleName:        'Role Name',
      roleDescription: 'Role Description',

      //Access Rights
      accessRightsTopMessage: 'This options allows to set the access rights for each role at transaction level for each module.',
      accessRightsList:       'Access Right List',
      moduleName:             'Module Name',
      transactionName:        'Transaction Name',
      transactionDescription: 'Transaction Description',
      transactionActionName:  'Transaction Action',

			//Module
      moduleTopMessage:  'This option allows to add, update, active, inactive, import and export the modules of the application.',
      moduleList:        'Module List',
      moduleName:        'Module Name',
      moduleDescription: 'Module Description',
      moduleOrder:       'Module Order',

			//Transaction
      transactionTopMessage:  'This option allows to add, update, active, inactive, import and export the transactions for each module for the application.',
      transactionList:        'Transaction List',
      transactionName:        'Transaction Name',
      transactionDescription: 'Transaction Description',
      transactionOrder:       'Transaction Order',

      //Dashboard
      //Dashboard
      dashboardTopMessage: 'This option allows to follow up how the users use the system and how many times they logged.',
      userLogged:           'User Logged',
      usersLoggedByDay:     'Users Logged By Day',
      topUserLogged:        'Top User Logged',
      actionsByUserLogged:   'Action By User Logged',
      usersLoggedByMonth:    'User Logged By Month',

      modulesUsed:          'Modules Used',
      modulesUsedByDay:     'Modules Used By Day',
      modulesUsedByMonth:   'Modules Used By Month',

      transactionsUsed:        'Transactions Used',
      transactionsUsedByDay:   'Transactions Used By Day',
      transactionsUsedByMonth: 'Transactions Used By Month',

      actionsUsed:          'Actions Used',
      actionsUsedByDay:     'Actions Used By Day',
      actionsUsedByMonth:   'Actions Used By Month',

      year:  'year',
      month: 'month',

      timesLogged:  'Times Logged',
      clicks:       'Clicks',

			//Traslations_Template Don´t Delete This Line

  },


  sp: {

      //App Menu
      appName:            'Roles Admin',
      menuOptions:        'Menú de Opciones',
      dashboard:          'Dashboard',
      modules:            'Módulos',
      module:             'Módulo',
      transactions:       'Transacciones',
      transaction:        'Transacción',
      roles:              'Roles',
      role:               'Rol',
      users:              'Usuarios',
      user:               'Usuario',
      accessRights:       'Permisos',
      transactionActions: 'Permisos',
      help:               'Ayuda',
      logout:             'Deslogearse',


      //Dates
      short_months: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
      long_months: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
      long_week_day: ['Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo'],
      shor_week_day: ['Lun', 'Mar', 'Mie','Jue','Vie','Sab','Dom'],

      //General
      id: 'Id',
      status: 'Estatus',
      createdBy: 'Fecha de Creación',
      updatedBy: 'Fecha de Modificación',
      actions: 'Acciones',
      links: 'Ligas',
      info: 'Info',
      active: 'Activo',
      inactive: 'Inactivo',
      searchFor: 'Buscar por...',
      processing: 'Procesando',
      new:        'Nuevo',

      //Buttons
      
      add:          'Nuevo',
      edit:         'Editar',
      save:         'Guardar',
      update:       'Actualizar',
      delete:       'Borrar',
      close:        'Cerrar',
      export:       'Exportar',
      import:       'Importar',
      clearFilter:  'Clear Filter',
      send:         'Enviar',
      reset:        'Resetear',
      expand:       'Expander',
      collapse:     'Colapsar',
      importFile:   'Importar Archivo',

      //Pagination
      start:        'Inicio',
      prev:         'Prev',
      next:         'Sig',
      end:          'Fin',
      noMorePages:  'No Más Páginas',
      showing:      'Mostrando',
      to:           'de',
      of:           'de',
      items:        'registros',

       //*** Login ***
      signIn:                 'Accesar',
      typeTheUsername:        'Ingresa el usuarios',
      typeThePassword:        'Ingresa la constraseña',
      typeTheEmailAddress:    'Ingresa una dirección de correo',
      typeTheEmailError:      'Ingresa una dirección de correo válida',
      rememberMe:             'Recordar Me',
      forgotYourPassword:     '¿Olvidaste Tú Constraseña?',
      loginUserDemo:          'Accesar como Usuarios Demo',
      getYourPassword:        'Obtén Tú Password,',
      getYourPassMsg:         'Ingrese la dirección de correo asociada a tú cuenta, posteriormente presiona el botón Enviar. Recibirás en un corrreo electrónico las instrucciones para resetear tu password.',
      resetYourPassword:      'Resetea Tú Password,',
      securtiyNumberMsg:      'Ingresa el Número de Seguridad que recibiste en tú correo electrónico, posteriormente captura tú nueva contraseña, confirmala y presiona el botón Resetear.',
      securtiyNumber:         'Número de Seguridad',
      typeTheSecurityNumber:  'Ingresa el Número de Seguridad',
      newPassword:            'Nueva Contraseña',
      typeTheNewPassword:     'Ingresa la Nueva Contraseña',
      newPasswordError:       'La contraseña requiere 8 caracteres como mínimo',
      confirmPassword:        'Confirma la Contraseña',
      typeTheConfirmPassword: 'Ingresa la Confirmación de la Contraseña',
      confirmPasswordError:   'La nueva contraseña y la confirmación deben ser iguales',


      //*** SECUTIRY ***

      //Users
      userTopMessage:  'Esta opción permite agregar, actualizar, activar, inactivar, importar y exportar los usuarios de la aplicación.',
      userList:        'Lista de Usuarios',
      username:        'Cuenta de Usuario',
      userFullname:    'Nombre de Usuario',
      userEmail:       'Cuenta de Correo',
     
      
       //Roles 
      roleTopMessage:  'Esta opción permite agregar, actualizar, activar, inactivar, importar y exportar los roles de la aplicación.',
      roleList:        'Lista de Roles',
      roleName:        'Role de Usuario',
      roleDescription: 'Descripción del Role',

      //Access RUghts
      accessRightsTopMessage: 'Está opción permite asignar los permisos a cada role a nivel transacción para cada módulo.',
      accessRightsList:       'Lista de Permisos',
      moduleName:             'Nombre de Módulo',
      transactionName:        'Nombre de Transacción',
      transactionDescription: 'Descripción de Transaction',
      transactionActionName:  'Permisos',

			//Module 
      moduleTopMessage:  'Esta opción permite agregar, actualizar, activar, inactivar, importar y exportar los módulos de la aplicación.',
      moduleList:        'Lista de Módulos',
      moduleName:        'Nombre de Módulo',
      moduleDescription: 'Descripción del Módulo',
      moduleOrder:       'Orden del Módulo',

			//Transaction
      transactionTopMessage:  'Esta opción permite agregar, actualizar, activar, inactivar, importar y exportar las transacciones de la aplicación.',
      transactionList:        'Lista de Transacciones',
      transactionName:        'Nombre de Transacción',
      transactionDescription: 'Descripción de Transacción',
      transactionOrder:       'Orden de Transacción',

      //Dashboard
      dashboardTopMessage: 'Es opción permite dar seguimiento al uso del sistema y a la cantidad de usuarios que se logean',
      userLogged:           'Usuarios Logeados',
      usersLoggedByDay:     'Usuarios Logeados por Día',
      topUserLogged:        'Usuarios Logeados',
      actionsByUserLogged:  'Acciones por Usuarios Logeados',
      usersLoggedByMonth:    'Usuarios Logeados por Mes',

      modulesUsed:          'Modulos Usados',
      modulesUsedByDay:     'Modulos Usados por Día',
      modulesUsedByMonth:   'Modulos Usados por Mes',

      transactionsUsed:        'Transacciones Usadas',
      transactionsUsedByDay:   'Transacciones Usadas por Día',
      transactionsUsedByMonth: 'Transacciones Usadas por Mes',

      actionsUsed:          'Acciones Usadas',
      actionsUsedByDay:     'Acciones Usadas por Día',
      actionsUsedByMonth:   'Acciones Usadas por Mes',

      year:  'Año',
      month: 'Mes',


      timesLogged:  'Accesos',
      clicks:       'Clicks',

			//Traslations_Template Don´t Delete This Line 

    
  },

};

</script>