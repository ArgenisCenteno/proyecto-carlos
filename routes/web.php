<?php

use App\Exports\ComprasExport;
use App\Exports\VentasExport;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $productos = Producto::with('imagenes')->limit(6)->get(); // Obtener 6 productos de la base de datos
    return view('welcome', compact('productos'));
});
Route::get('/products', [CarritoController::class, 'products'])->name('products');
Route::get('/detalles/{id}', [CarritoController::class, 'detalles'])->name('detalles');
Route::post('/agregar/{id}', [CarritoController::class, 'agregarCarrito'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'show'])->name('carrito.show');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizarCarrito'])->name('carrito.actualizar');
Route::get('/category/{id}', [CarritoController::class, 'productosPorCategoria'])->name('productosPorCategoria');


  
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/checkout', [CarritoController::class, 'checkout'])->name('pagar');
Route::post('/pagarCuenta', [PagoController::class, 'pagarCuenta'])->name('pagarCuenta');

//Notificaciones

Route::get('notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
Route::get('notificaciones/{id}', [NotificacionController::class, 'show'])->name('notificaciones.show');
Route::post('notificaciones/mark-all-read', [NotificacionController::class, 'markAllAsRead'])->name('notificaciones.markAllAsRead');
Route::delete('notificaciones/{id}', [NotificacionController::class, 'destroy'])->name('notificaciones.destroy');


/* ALMACEN DE PRODUCTOS */
Route::get('/almacen', [ProductoController::class, 'almacen'])->name('almacen');
Route::post('/registrar-producto', [ProductoController::class, 'store'])->name('registrar-producto');
Route::resource('productos', App\Http\Controllers\ProductoController::class);
Route::get('/imagenes/{id}', [ProductoController::class, 'imagenesProducto'])->name('imagenes-producto');
Route::delete('/removerImagen/{id}', [ProductoController::class, 'removerImagen'])->name('removerImagen');
Route::post('/agregarImagen/{id}', [ProductoController::class, 'agregarImagen'])->name('agregarImagen');

/* CATEGORIAS Y SUBCATEGORIAS*/
Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
Route::resource('subcategorias', App\Http\Controllers\SubCategoriaController::class);
Route::get('/datos/export', [ProductoController::class, 'export'])->name('productoss.export');
Route::get('ventas/export', function () {
    return Excel::download(new VentasExport, 'ventas.xlsx');
})->name('ventas.export');
Route::get('compras/export', function () {
    return Excel::download(new ComprasExport, 'compras.xlsx');
})->name('compras.export');
/* CAJAS */
Route::resource('cajas', App\Http\Controllers\CajaController::class);
Route::get('/aperturar/{id}', [CajaController::class, 'aperturarCaja'])->name('cajas.aperturar');
Route::post('/registrarApertura/{id}', [CajaController::class, 'registrarApertura'])->name('cajas.registrarApertura');
Route::post('/notificaciones/{id}/marcar-como-leida', [NotificacionController::class, 'markAsRead'])->name('notificaciones.markAsRead');
Route::post('/notificaciones/marcar-todas-leidas', [NotificacionController::class, 'markAllAsRead'])->name('notificaciones.markAllAsRead');

/* VENTAS */
Route::resource('ventas', App\Http\Controllers\VentaController::class);
Route::get('/vender', [VentaController::class, 'vender'])->name('ventas.vender');
Route::get('/datatableProductoVenta', [VentaController::class, 'datatableProductoVenta'])->name('ventas.datatableProductoVenta');
Route::post('/generarVenta', [VentaController::class, 'generarVenta'])->name('ventas.generarVenta');
Route::get('/pdfVenta/{id}', [PdfController::class, 'pdfVenta'])->name('ventas.pdf');

// Ruta para obtener un producto por su ID
Route::get('/producto/{id}', [VentaController::class, 'obtenerProducto'])->name('productos.obtener');


/* TASAS, MONEDAS E IMPUESTOS */
Route::resource('tasas', App\Http\Controllers\TasasController::class);
Route::resource('entregas', App\Http\Controllers\EntregaController::class);

/* COMPRAS */
Route::resource('compras', App\Http\Controllers\CompraController::class);
Route::get('/comprar', [CompraController::class, 'comprar'])->name('compras.comprar');
Route::get('/datatableProductoCompra', [CompraController::class, 'datatableProductoCompras'])->name('compras.datatableProductoCompra');
Route::post('/generarCompra', [CompraController::class, 'generarCompra'])->name('compras.generarCompra');
Route::get('/pdfCompra/{id}', [PdfController::class, 'pdfCompra'])->name('compras.pdf');

/* PROVEEDORES */
Route::resource('proveedores', App\Http\Controllers\ProveedorController::class);

/* PAGOS */
Route::resource('pagos', App\Http\Controllers\PagoController::class);
Route::get('/pdfPago/{id}', [PdfController::class, 'pdfPago'])->name('pagos.pdf');

/* PAGOS */
Route::resource('usuarios', App\Http\Controllers\UserController::class);
Route::get('/pdfUser/{id}', [PdfController::class, 'pdfEstadoCuenta'])->name('usuarios.pdf');
});


// Ruta de inicio de sesión
Route::post('/buscar', [ProductoController::class, 'buscar'])->name('buscar');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes();

