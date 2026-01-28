DROP DATABASE IF EXISTS ctf_challenge;
CREATE DATABASE ctf_challenge;
USE ctf_challenge;

CREATE TABLE citizens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    sector VARCHAR(100),
    status VARCHAR(50),
    compliance VARCHAR(100)
);

INSERT INTO citizens (name, sector, status, compliance) VALUES
('Marcus Webb', 'Industrial-7G', 'MONITORED', '97.3%'),
('Elena Cross', 'Residential-4A', 'CLEARED', '99.1%'),
('David Chen', 'Commercial-2B', 'FLAGGED', '78.5%'),
('Sarah Mitchell', 'Downtown-1C', 'MONITORED', '94.8%'),
('James Norton', 'Outskirts-9F', 'RESTRICTED', '62.1%');

CREATE TABLE th3_0rd3r_0f_ch40s (
    m0r14rtys_s3cr3t VARCHAR(255)
);

INSERT INTO th3_0rd3r_0f_ch40s (m0r14rtys_s3cr3t) VALUES ('IET{fr33_w1ll_f@1l3d_v@l1d@t10n}');
