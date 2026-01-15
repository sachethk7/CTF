DROP DATABASE IF EXISTS ctf_challenge;
CREATE DATABASE ctf_challenge;
USE ctf_challenge;

CREATE TABLE dogs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    breed VARCHAR(100),
    color VARCHAR(50),
    owner VARCHAR(100)
);

INSERT INTO dogs (name, breed, color, owner) VALUES
('Buddy', 'Golden Retriever', 'Golden', 'John Smith'),
('Max', 'German Shepherd', 'Black and Tan', 'Jane Doe'),
('Bella', 'Labrador', 'Chocolate', 'Bob Johnson'),
('Charlie', 'Beagle', 'Tri-color', 'Alice Brown'),
('Rocky', 'Bulldog', 'White', 'David Wilson');

CREATE TABLE w0w_y0u_f0und_m3 (
    f0und_m3 VARCHAR(255)
);

INSERT INTO w0w_y0u_f0und_m3 (f0und_m3) VALUES ('abctf{uni0n_1s_4_gr34t_c0mm4nd}');
