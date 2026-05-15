-- 1. Creación de la estructura de la tabla
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cat VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    units INT NOT NULL
);

-- 2. Inserción de los datos reales del inventario
INSERT INTO items (name, cat, price, units) VALUES 
('Laptop Gaming MSI', 'Electrónica', 1250.99, 5),
('Silla Ergonómica Pro', 'Mobiliario', 189.50, 12),
('Monitor 4K 27 pulgadas', 'Electrónica', 340.00, 8),
('Escritorio Elevable L', 'Mobiliario', 450.00, 3),
('Teclado Mecánico RGB', 'Electrónica', 85.00, 20),
('Ratón Inalámbrico Pro', 'Electrónica', 45.99, 15),
('Estantería Metálica', 'Mobiliario', 75.00, 10);
