<?php
/*
    El siguiente archivo controla el direccionamiento de todas las rutas en el sistema entre controladores y vistas
*/

//  W E L C O M E - Ruta que muestra la vista principal del sistema, sin iniciar sesión
Route::get('/', function () {
    return view('welcome');
});

/*
 *  U S U A R I O S
 *  Rutas que manipula el direccionamiento entre las vistas y controlador de Usuario y Auth(propiamente Laravel)
*/
Auth::routes();
Route::resource('users', 'UserController');

/*
    H O M E
    Direccionamiento a la vista principal del sistema,
    recibe información de bienes, incidencias, unidades
    y usuarios para presentar información en gráficos
*/
Route::get('/home', function () {
    $assets = \App\Entities\Asset::all();
    $incidences = \App\Entities\Incidence::all();
    $normals = $assets->where('status_id','==','1');
    $preregistereds = $assets->where('status_id','==','2');
    $surplus = $assets->where('status_id','==','3');
    return view('home')->with('assets',$assets)->with('incidences',$incidences)->with('preregistereds',$preregistereds)
        ->with('surplus',$surplus)->with('normals',$normals);
});

/*
 *  B I E N E S     P R E - R E G I S T R A D O S
 *  Direccionamiento del controlador en general de Bienes Pre-registrados, a su index y al método "scan"
*/
Route::resource('preregister', 'PreregisteredController');
Route::resource('preregistered', 'PreregisteredController@index');
Route::get('preregistered/{id}/scan', 'PreregisteredController@scan');

/*
 *  B I E N E S     N O R M A L E S (ESCANEADOS)
 *  Direccionamiento del controlador de Bienes Normales,
 *  Métodos: index, edit, update, destroy
*/
Route::resource('normal', 'NormalController');
Route::get('normal/{id}/scan', 'NormalController@scan');

/*
 *  B I E N E S     S O B R A N T E S
 *  Direccionamiento del controlador de Bienes Sobrantes
 *  Cuenta con todos los métodos de "resource"(index, create, store, update, edit, destroy)
*/
Route::resource('surplus', 'SurplusController');

/*
 *  I N C  I D E  N C I A S
 *  Direccionamiento a los métodos dentro del controlador de Incidencias
 *  Métodos: index, create, store, update, edit
 *  Direccionamiento al controlador para crear tipos de incidencias
*/
Route::resource('incidence', 'IncidenceController');
Route::resource('incidenceType', 'IncidenceTypeController');

/*
 *  U N I D A D E S
 *  Direccionamiento al controlador de Unidades,
 *  cuenta con todos los métodos propios del "resource"
*/
Route::resource('unit', 'UnitController');

/*
 *  E N C A R G A D O S
 *  Direccionamiento al controlador de Encargados de unidad,
 *  cuenta con todos los métodos propios del "resource"
*/
Route::resource('employee', 'EmployeeController');

/*
 *  T I P O     D E     B I E N E S
 *  Direccionamiento al controlador de Tipos de bienes,
 *  cuenta con todos los métodos propios del "resource"
*/
Route::resource('assetsTypes', 'AssetsTypeController');

/*
 *  M A R C A S
 *  Direccionamiento al controlador de Marcas,
 *  cuenta con todos los métodos propios del "resource"
*/
Route::resource('brand', 'BrandController');

/*
 *  P R O V E E E D O R E S
 *  Direccionamiento al controlador de Proveedores,
 *  cuenta con todos los métodos propios del "resource"
*/
Route::resource('provider', 'ProviderController');

/*
 *  P R O G R A M A S      A C A D É M I C O S
 *  Direccionamiento al controlador de Programas académicos,
 *  cuenta con todos los métodos propios del "resource"
*/
Route::resource('program', 'ProgramController');

/*
 *  I N V E N T A R I O S
 *  Direccionamiento al controlador de Inventarios
 *  cuenta con 2 métodos, index y store, para cargar información y generar, respectivamente
*/
Route::resource('inventories', 'InventoryController');

/*
 *  R E P O R T E S
 *  Direccionamiento al controlador de Reportess
 *  cuenta con 2 métodos, index y store, para cargar información y generar, respectivamente
*/
Route::resource('reports', 'ReportController');

/*
 *  E X C E L ( IMPORTAR/EXPORTAR)
 *  Ruta que presenta la vista para importar o exportar un archivo de excel
*/
Route::get('/excel', function () {
    return view('excel.excel');
});
// Ruta que llama a la acción de importar en el controlador
Route::post('/excelImport','ExcelController@excelImport');
// Ruta que llama a la acción de exportar en el controlador
Route::get('/excelExport','ExcelController@excelExport');
