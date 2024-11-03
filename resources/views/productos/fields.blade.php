<div class="container">
    <div class="row">
        <!-- Nombre Field -->
        <div class="form-group col-sm-12 col-md-4">
            {!! Form::label('nombre', 'Nombre:', ['class' => 'bold']) !!}
            {!! Form::text('nombre', null, ['class' => 'form-control round', 'required']) !!}
        </div>

        <!-- Descripción Field -->
        <div class="form-group col-sm-12 col-md-4">
            {!! Form::label('descripcion', 'Descripción:', ['class' => 'bold']) !!}
            {!! Form::text('descripcion', null, ['class' => 'form-control round', 'rows' => 3, 'required']) !!}
        </div>

        <!-- Precio Compra Field -->
        <div class="form-group col-sm-12 col-md-4">
            {!! Form::label('precio_compra', 'Precio Compra:', ['class' => 'bold']) !!}
            {!! Form::number('precio_compra', null, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_compra', 'required']) !!}
            <p id="precio_compra_error" style="color: red; display: none;">El precio de compra no puede ser negativo.
            </p>
        </div>
    </div>

    <div class="row">
        <!-- Precio Venta Field -->
        <div class="form-group col-sm-12 col-md-4">
            {!! Form::label('precio_venta', 'Precio Venta:', ['class' => 'bold']) !!}
            {!! Form::number('precio_venta', null, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_venta', 'required']) !!}
            <p id="precio_venta_error" style="color: red; display: none;">El precio de venta no puede ser negativo o menor al precio de compra.</p>
        </div>

        <!-- Aplica IVA Field -->
        <div class="form-group col-sm-12 col-md-4 d-none">
            {!! Form::label('aplica_iva', 'Aplica IVA:', ['class' => 'bold']) !!}
            {!! Form::select('aplica_iva', ['1' => 'Sí', '0' => 'No'], null, ['class' => 'form-control round', 'required']) !!}
        </div>

        <!-- Cantidad Field -->
        <div class="form-group col-sm-12 col-md-4">
    {!! Form::label('cantidad', 'Stock:', ['class' => 'bold']) !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control round', 'step' => '1', 'min' => '0', 'required']) !!}
</div>

    </div>

    <div class="row">
        <!-- Subcategoría Field -->
        <div class="form-group col-sm-12 col-md-4">
            {!! Form::label('sub_categoria_id', 'Subcategoría:', ['class' => 'bold']) !!}
            {!! Form::select('sub_categoria_id', $subcategorias, null, ['class' => 'form-control round', 'placeholder' => 'Selecciona una subcategoría', 'required']) !!}
        </div>

        <!-- Disponible Field -->
        <div class="form-group col-sm-12 col-md-4 d-none">
            {!! Form::label('disponible', 'Disponible:', ['class' => 'bold']) !!}
            {!! Form::select('disponible', ['1' => 'Disponible', '0' => 'No Disponible'], null, ['class' => 'form-control round', 'required']) !!}
        </div>

        <!-- Campo de imágenes -->
        <div class="form-group col-sm-12 col-md-4">
            {!! Form::label('imagenes', 'Contenido Multimedia:', ['class' => 'bold']) !!}
            {!! Form::file('imagenes[]', ['class' => 'form-control round', 'accept' => 'image/*', 'multiple' => true, 'id' => 'imagenes']) !!}
            <p id="imagenes_error" style="color: red; display: none;">Puedes subir hasta 5 imágenes.</p>
        </div>
    </div>

    <!-- Contenedor para previsualizar las imágenes -->
    <div class="row">
        <div class="form-group col-sm-12 col-md-12" id="imagenes-preview"></div>
    </div>

    <!-- Botones de acción -->
    <div class="float-end">
        {!! Form::submit('Aceptar', ['class' => 'btn btn-primary round', 'id' => 'submit_btn', 'onclick' => 'confirmSubmission(event)', 'disabled' => false]) !!}
    </div>

</div>

<script src="{{asset('js/sweetalert2.js')}}"></script>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let precioCompraInput = document.getElementById('precio_compra');
        let precioVentaInput = document.getElementById('precio_venta');
        let submitBtn = document.getElementById('submit_btn');
        let precioCompraError = document.getElementById('precio_compra_error');
        let precioVentaError = document.getElementById('precio_venta_error');
        let imagenesInput = document.getElementById('imagenes');
        let previewContainer = document.getElementById('imagenes-preview');
        let imagenesError = document.getElementById('imagenes_error');

        // Función para manejar la previsualización y eliminación de imágenes
        imagenesInput.addEventListener('change', function (event) {
            let files = event.target.files;
            let maxFiles = 5; // Máximo de archivos permitidos

            // Limpiar la previsualización actual
            previewContainer.innerHTML = '';

            // Validar cantidad de archivos seleccionados
            if (files.length > maxFiles) {
                imagenesError.style.display = 'block';
                imagenesInput.value = ''; // Limpiar la selección de archivos
                return;
            } else {
                imagenesError.style.display = 'none';
            }

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
                    img.style.width = '200px';
                    img.style.height = '200px';
                    img.style.objectFit = 'cover';

                    let removeBtn = document.createElement('button');
                    removeBtn.innerText = 'x';
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

<script src="{{asset('js/sweetalert2.js')}}"></script>
