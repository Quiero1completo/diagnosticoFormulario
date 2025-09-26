document.addEventListener('DOMContentLoaded', function() {
   
    cargarBodegas();
    cargarMonedas();

    const bodegaSelect = document.getElementById('bodega');

    bodegaSelect.addEventListener('change', function() {
        cargarSucursales(this.value);
    });

    const form = document.getElementById('productForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        validarYGuardar();
    });
});


function cargarBodegas() {
    fetch('/controllers/get_bodegas.php')
        .then(response => response.json())
        .then(data => {
            const bodegaSelect = document.getElementById('bodega');
            bodegaSelect.innerHTML = '<option value="">Seleccionar...</option>';
            data.forEach(bodega => {
                const option = document.createElement('option');
                option.value = bodega.id;
                option.textContent = bodega.nombre;
                bodegaSelect.appendChild(option);
            });
        });
}

function cargarSucursales(bodegaId) {
    const sucursalSelect = document.getElementById('sucursal');
    sucursalSelect.innerHTML = '<option value="">Seleccionar...</option>';

    if (bodegaId) {
        fetch(`/controllers/get_sucursales.php?bodega_id=${bodegaId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(sucursal => {
                    const option = document.createElement('option');
                    option.value = sucursal.id;
                    option.textContent = sucursal.nombre;
                    sucursalSelect.appendChild(option);
                });
            });
    }
}

function cargarMonedas() {
    fetch('/controllers/get_monedas.php')
        .then(response => response.json())
        .then(data => {
            const monedaSelect = document.getElementById('moneda');
            monedaSelect.innerHTML = '<option value="">Seleccionar...</option>';
            data.forEach(moneda => {
                const option = document.createElement('option');
                option.value = moneda.id;
                option.textContent = moneda.nombre;
                monedaSelect.appendChild(option);
            });
        });
}

function validarYGuardar() {

    const codigo = document.getElementById('codigo').value.trim();
    if (!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,15}$/.test(codigo)) {
        alert("El código del producto debe contener letras y números, y tener entre 5 y 15 caracteres.");
        return;
    }
    const nombre = document.getElementById('nombre').value.trim();
    if (nombre.length < 2 || nombre.length > 50) {
        alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
        return;
    }
    const bodega = document.getElementById('bodega').value;
    if (bodega === "") {
        alert("Debe seleccionar una bodega."); 
        return;
    }
    const sucursal = document.getElementById('sucursal').value;
    if (sucursal === "") {
        alert("Debe seleccionar una sucursal para la bodega seleccionada."); 
         return;
    }
    const moneda = document.getElementById('moneda').value;
    if (moneda === "") {
        alert("Debe seleccionar una moneda para el producto.");
        return;
    }
    const precioInput = document.getElementById('precio').value.trim();
    const precioRegex = /^\d+([.,]\d{1,2})?$/;
    if (precioInput === "" || !precioRegex.test(precioInput)) {
        alert("El precio debe ser un número positivo o cero, con un máximo de dos decimales (usando punto o coma).");
        return;
    }
    const materiales = document.querySelectorAll('input[name="material[]"]:checked');
    if (materiales.length < 2) {
        alert("Debe seleccionar al menos dos materiales para el producto.");
        return;
    }
    const descripcion = document.getElementById('descripcion').value.trim();
    if (descripcion.length < 10 || descripcion.length > 1000) {
        alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
        return;
    }

    const formData = new FormData(document.getElementById('productForm'));
    const precioValue = formData.get('precio').replace(',', '.');
    formData.set('precio', precioValue);

    fetch('/controllers/post_producto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Producto guardado exitosamente.');
            document.getElementById('productForm').reset();
            document.getElementById('sucursal').innerHTML = '<option value="">Seleccionar...</option>';
        } else {
            alert(`Error al guardar: ${data.message}`);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud fetch:', error);
        alert(`Ocurrió un error al contactar al servidor. Por favor, revisa la consola para detalles. (${error.message})`);
    });
}