-- Categories Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Products Table
CREATE TABLE products (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(255) NOT NULL,
      category_id INT,
      FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Product Options Table
CREATE TABLE product_options (
     id INT AUTO_INCREMENT PRIMARY KEY,
     product_id INT NOT NULL,
     name VARCHAR(255) NOT NULL,
     image_path VARCHAR(255),
     price DECIMAL(10, 2) NOT NULL,
     FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Cart Table
CREATE TABLE cart (
      id INT AUTO_INCREMENT PRIMARY KEY,
      product_id INT NOT NULL,
      FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
