<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('nombre', 'Nombre:', ['class' => 'bold']) !!}
        {!! Form::text('nombre', $producto->nombre, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Descripción Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('descripcion', 'Descripción:', ['class' => 'bold']) !!}
        {!! Form::text('descripcion', $producto->descripcion, ['class' => 'form-control round', 'rows' => 3, 'required']) !!}
    </div>

    <!-- Precio Compra Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('precio_compra', 'Precio Compra:', ['class' => 'bold']) !!}
        {!! Form::number('precio_compra', $producto->precio_compra, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_compra', 'required']) !!}
        <p id="precio_compra_error" style="color: red; display: none;">El precio de compra no puede ser negativo.</p>
    </div>
</div>

<div class="row">
    <!-- Precio Venta Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('precio_venta', 'Precio Venta:', ['class' => 'bold']) !!}
        {!! Form::number('precio_venta', $producto->precio_venta, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_venta', 'required']) !!}
        <p id="precio_venta_error" style="color: red; display: none;">El precio de venta no puede ser negativo.</p>
    </div>

    <!-- Aplica IVA Field -->
    <div class="form-group col-sm-12 col-md-4 d-none">
        {!! Form::label('aplica_iva', 'Aplica IVA:', ['class' => 'bold']) !!}
        {!! Form::select('aplica_iva', ['1' => 'Sí', '0' => 'No'], $producto->aplica_iva, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Cantidad Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('cantidad', 'Stock:', ['class' => 'bold']) !!}
        {!! Form::number('cantidad', $producto->cantidad, ['class' => 'form-control round', 'step' => '1', 'required']) !!}
    </div>
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('sub_categoria_id', 'Subcategoría:', ['class' => 'bold']) !!}
        {!! Form::select('sub_categoria_id', $subcategorias, $producto->sub_categoria_id, ['class' => 'form-control round', 'placeholder' => 'Selecciona una subcategoría', 'required']) !!}
    </div>
</div>

<div class="row">
    <!-- Subcategoría Field -->
  

    <!-- Disponible Field -->
    <div class="form-group col-sm-12 col-md-4 d-none">
        {!! Form::label('disponible', 'Disponible:', ['class' => 'bold']) !!}
        {!! Form::select('disponible', ['1' => 'Disponible', '0' => 'No Disponible'], $producto->disponible, ['class' => 'form-control round', 'required']) !!}
    </div>



    <div class="row mt-4">
    <!-- Imágenes Existentes -->
    <div class="form-group col-sm-12 col-md-6">
        <div class="row">
            @foreach($imagenes as $imagen)
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset($imagen->url) }}" class="card-img-top img-thumbnail" alt="Imagen del producto" style="width: 200px; height: auto;">
                        <div class="card-body d-flex justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm btn-remove-image"
                                data-url="{{ route('removerImagen', ['id' => $imagen->id]) }}">
                                <span>Eliminar</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Input para subir nuevas imágenes -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('imagenes', 'Seleccionar Nuevas Imágenes:', ['class' => 'bold']) !!}
        {!! Form::file('imagenes[]', ['class' => 'form-control round', 'accept' => 'image/*', 'multiple' => true, 'id' => 'imagenes2']) !!}
        <small class="text-muted">Puedes subir hasta 5 nuevas imágenes.</small>
        <div class="form-group mt-3" id="imagenes-preview2"></div>
    </div>
</div>


<!-- Contenedor para previsualizar las imágenes -->
<div class="form-group col-sm-12 col-md-12" id="imagenes-preview"></div>

<!-- Botones de acción -->
<div class="float-end">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary round', 'id' => 'submit_btn', 'disabled' => false]) !!}
</div>

<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let imagenesInput = document.getElementById('imagenes2');
        let previewContainer = document.getElementById('imagenes-preview2');
        let imagenesError = document.getElementById('imagenes_error2');

        // Función para manejar la previsualización y eliminación de imágenes
        imagenesInput.addEventListener('change', function (event) {
            let files = event.target.files;
            let maxFiles = 5; // Máximo de archivos permitidos

            // Limpiar la previsualización actual
            previewContainer.innerHTML = '';


            // Mostrar previsualización de cada imagen seleccionada
            Array.from(files).forEach((file) => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgContainer = document.createElement('div');
                    imgContainer.style.position = 'relative';
                    imgContainer.style.display = 'inline-block';
                    imgContainer.style.margin = '5px';

                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';

                    let removeBtn = document.createElement('button');
                    removeBtn.innerText = 'X';
                    removeBtn.classList.add('btn', 'btn-secondary');

                    removeBtn.style.cursor = 'pointer';

                    removeBtn.addEventListener('click', function () {
                        imgContainer.remove();
                        let dt = new DataTransfer();
                        for (let i = 0; i < files.length; i++) {
                            if (files[i] !== file) {
                                dt.items.add(files[i]);
                            }
                        }
                        imagenesInput.files = dt.files;
                    });

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    previewContainer.appendChild(imgContainer);
                }
                reader.readAsDataURL(file);
            });
        });

        // Manejar eliminación de imágenes actuales
        $('.btn-remove-image').click(function (event) {
            event.preventDefault();
            var url = $(this).data('url');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará la imagen permanentemente.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la petición AJAX para eliminar la imagen
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire(
                                '¡Eliminado!',
                                'La imagen ha sido eliminada exitosamente.',
                                'success'
                            );
                            location.reload(); // Recargar la página después de eliminar la imagen
                        },
                        error: function (error) {
                            console.error('Error al eliminar la imagen:', error);
                            Swal.fire(
                                'Error',
                                'Hubo un error al intentar eliminar la imagen.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });

</script>
<script>
$(document).ready(function() {
    // Validar que el precio de compra no sea negativo
    $('#precio_compra').on('input', function() {
        var value = parseFloat($(this).val());
        if (value < 0) {
            $('#precio_compra_error').show(); // Muestra el mensaje de error
            $(this).removeClass('is-valid').addClass('is-invalid'); // Establece clase de error
        } else {
            $('#precio_compra_error').hide(); // Oculta el mensaje de error
            $(this).removeClass('is-invalid').addClass('is-valid'); // Establece clase válida
        }
    });

    // Validar que el precio de venta no sea negativo y que no sea mayor que el precio de compra
    $('#precio_venta').on('input', function() {
        var value = parseFloat($(this).val());
        var precioCompra = parseFloat($('#precio_compra').val());

        // Validar que el precio de venta sea positivo y no esté vacío
        if (value <= 0 || isNaN(value)) {
            $('#precio_venta_error').show(); // Muestra el mensaje de error
            $(this).removeClass('is-valid').addClass('is-invalid'); // Establece clase de error
        } else if (value < precioCompra) {
            // Si el precio de venta es menor que el precio de compra, muestra el mensaje de error
            $('#precio_venta_error').show(); // Muestra el mensaje de error
            $(this).removeClass('is-valid').addClass('is-invalid'); // Establece clase de error
        } else {
            $('#precio_venta_error').hide(); // Oculta el mensaje de error
            $(this).removeClass('is-invalid').addClass('is-valid'); // Establece clase válida
        }
    });

    // Validar que la cantidad sea mayor que 0 y no esté vacía
    $('#cantidad').on('input', function() {
        var value = parseInt($(this).val());
        
        // Verificar que la cantidad sea un número mayor que 0 y que no esté vacío
        if (value < 1 || isNaN(value) || $(this).val().trim() === '') {
            $(this).removeClass('is-valid').addClass('is-invalid'); // Establece clase de error
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid'); // Establece clase válida
        }
    });
});
</script>