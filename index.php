<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Formulario de Producto</h1>
        <form id="productForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" id="codigo" name="codigo">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="bodega">Bodega</label>
                    <select id="bodega" name="bodega">
                        <option value="">Seleccionar...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sucursal">Sucursal</label>
                    <select id="sucursal" name="sucursal">
                        <option value="">Seleccionar...</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="moneda">Moneda</label>
                    <select id="moneda" name="moneda">
                        <option value="">Seleccionar...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" id="precio" name="precio">
                </div>
            </div>

            <div class="form-group">
                <label>Material del Producto</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="material[]" value="Plástico"> Plástico</label>
                    <label><input type="checkbox" name="material[]" value="Metal"> Metal</label>
                    <label><input type="checkbox" name="material[]" value="Madera"> Madera</label>
                    <label><input type="checkbox" name="material[]" value="Vidrio"> Vidrio</label>
                    <label><input type="checkbox" name="material[]" value="Textil"> Textil</label>
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"></textarea>
            </div>

            <button type="submit" class="btn-guardar">Guardar Producto</button>
        </form>
    </div>

    <script src="/script.js"></script>
</body>
</html>