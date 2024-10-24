@extends('layout.app')

@section('content')
<main   id="main"  class="main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="border-0 my-5">
                        <div class="px-2 row">
                            <!-- Mensaje de éxito o error -->
                            <div class="col-lg-12">
                                @include('flash::message')
                            </div>

                            <!-- Título y botón para redirigir -->
                            <div class="col-md-12 text-center mb-4">
                                <h3 class="p-2 bold"> <strong>Generar Compra</strong> </h3>
                            </div>

                           
                        </div>

                        <!-- Contenedor de los formularios de compra y el datatable -->
                        <div class="row">
                        <div class="col-md-6">
                            @include('compras.datatableProductos')
                               
                            </div>
                        <div class="col-md-6">
                                
                                @include('compras.fields_compra')
                                </div>
                            <!-- Columna para fields_compra -->
                          

                            <!-- Columna para datatableProductos -->
                           
                        </div> <!-- Fin del row -->
                    </div> <!-- Fin del contenedor de la compra -->
                </div> <!-- Fin del col-lg-12 -->
            </div> <!-- Fin del row -->
        </div> <!-- Fin del animated fadeIn -->
    </div> <!-- Fin del container-fluid -->
</main>
@endsection
