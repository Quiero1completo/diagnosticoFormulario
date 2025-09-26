
CREATE TABLE bodegas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE sucursales (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    bodega_id INT REFERENCES bodegas(id)
);

CREATE TABLE monedas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    simbolo VARCHAR(10) NOT NULL
);

CREATE TABLE productos (
    id SERIAL PRIMARY KEY,
    codigo_producto VARCHAR(15) UNIQUE NOT NULL,
    nombre_producto VARCHAR(50) NOT NULL,
    bodega_id INT REFERENCES bodegas(id),
    sucursal_id INT REFERENCES sucursales(id),
    moneda_id INT REFERENCES monedas(id),
    precio NUMERIC(10, 2) NOT NULL,
    materiales VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--Datos de prueba

INSERT INTO bodegas (nombre) VALUES ('Bodega A'), ('Bodega B');
INSERT INTO monedas (nombre, simbolo) VALUES ('DÓLAR', '$'), ('EURO', '€');

INSERT INTO sucursales (nombre, bodega_id) 
VALUES 
    ('Sucursal 1', 1), 
    ('Sucursal 2', 1), 
    ('Sucursal 3', 2);