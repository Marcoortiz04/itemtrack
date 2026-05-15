-- Estructura de la tabla
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cat VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    units INT NOT NULL
);

-- Datos de ejemplo
INSERT INTO items (name, cat, price, units) VALUES 
('Laptop Gaming', 'Electrónica', 1200.00, 5),
('Silla Oficina', 'Mobiliario', 150.00, 10);