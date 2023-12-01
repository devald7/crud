CREATE DATABASE crud;
USE crud;

CREATE TABLE datos(
codigo INT AUTO_INCREMENT PRIMARY KEY,
unidad VARCHAR(100),
cargo VARCHAR(100),
nombre VARCHAR(150),
apellido VARCHAR(100),
email VARCHAR(100)
);

/*
ALTER TABLE datos
ADD CONSTRAINT fk_directorio
FOREIGN KEY (id_directorio)
REFERENCES directorio (id);
*/
CREATE TABLE directorio(
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(250),
tipo ENUM('Dependencia', 'Facultad') NOT NULL,
abreviatura VARCHAR(10),
id_directorio INT,
habilitado BOOLEAN DEFAULT TRUE
);

-- Agregar Dependencias
INSERT INTO directorio (nombre, tipo, abreviatura) VALUES
INSERT INTO directorio (nombre, tipo, abreviatura) VALUES
('1551 INCUBADORA DE EMPRESAS INNOVADORAS (1551)', 'Dependencia', 'IEIN(1551)'),
('ALIANZA ESTRATÉGICA', 'Dependencia', 'AEST'),
('AUTOSEGURO', 'Dependencia', 'ASEG'),
('BECA 18', 'Dependencia', 'BEC18'),
('CENTRO CULTURAL', 'Dependencia', 'CCU'),
('CENTRO DE IDIOMAS UNMSM', 'Dependencia', 'CIUNMSM'),
('CENTRO DE INFORMÁTICA UNMSM', 'Dependencia', 'CIIUNMSN'),
('CENTRO DE INVESTIGACIÓN DE RECURSOS NATURALES (CIRNA)', 'Dependencia', 'CIRNA'),
('CENTRO DE PRODUCCIÓN E IMPRENTACENTRO DE IDIOMAS UNMSM', 'Dependencia', 'CIUNMSM'),
('CENTRO PREUNIVERSITARIO', 'Dependencia', 'CEPRE'),
('CLINICA UNIVERSITARIA', 'Dependencia', 'CLUNI'),
('COLEGIO REAL', 'Dependencia', 'COREA'),
('COMISIONES PERMANENTES', 'Dependencia', 'COPER'),
('CONTROL PREVIO Y FISCALIZACIÓN', 'Dependencia', 'CPFIS'),
('DIRECCIÓN DE CENTROS DE DESARROLLO REGIONAL', 'Dependencia', 'DCDRE'),
('DIRECCIÓN DEL FONDO EDITORIAL Y LIBRERIA', 'Dependencia', 'DFELI'),
('DIRECCIÓN DEL SISTEMA DE BIBLIOTECAS Y BIBLIOTECA CENTRAL', 'Dependencia', 'DISBB'),
('DIRECCIÓN GENERAL DE ADMINISTRACIÓN', 'Dependencia', 'DIRGA'),
('DIRECCIÓN GENERAL DE BIBLIOTECAS Y PUBLICACIONES', 'Dependencia', 'DIGBP'),
('DIRECCIÓN GENERAL DE ESTUDIOS DE POSGRADO', 'Dependencia', 'DIGEP'),
('DIRECCIÓN GENERAL DE RESPONSABILIDAD SOCIAL', 'Dependencia', 'DIGRES'),
('DIRECCIÓN GENERAL DE UNIDADES DESCONCENTRADAS', 'Dependencia', 'DIRGUD'),
('FUNDACIÓN SAN MARCOS', 'Dependencia', 'FUSAM'),
('INSTITUTO RAÚL PORRAS BARRENECHEA', 'Dependencia', 'IRPOB'),
('JARDINES BOTÁNICOS Y JARDÍN ECOLÓGICO', 'Dependencia', 'JABJE'),
('JOVENES EMPRENDEDORES', 'Dependencia', 'JOVEMP'),
('MUSEO DE HISTORIA NATURAL', 'Dependencia', 'MUHNA'),
('MUSEO TEMPLE RADICATI', 'Dependencia', 'MUTRA'),
('OFICINA CENTRAL DE ADMISIÓN', 'Dependencia', 'OFICA'),
('OFICINA CENTRAL DE CALIDAD ACADÉMICA Y ACREDITACIÓN', 'Dependencia', 'OCCAA'),
('OFICINA DE ABASTECIMIENTO', 'Dependencia', 'OFIAB'),
('OFICINA DE CONTABILIDAD', 'Dependencia', 'OFICO'),
('OFICINA DE EDUCACIÓN VIRTUAL UNMSM', 'Dependencia', 'OFIEV'),
('OFICINA DE SECRETARÍA GENERAL', 'Dependencia', 'OFISGE'),
('OFICINA DE SEGURIDAD Y VIGILANCIA', 'Dependencia', 'OFISVI'),
('OFICINA DE TESORERÍA', 'Dependencia', 'OFITE'),
('OFICINA DEL SISTEMA ÚNICO DE MATRÍCULA', 'Dependencia', 'OFISUM'),
('OFICINA GENERAL DE ASESORÍA LEGAL', 'Dependencia', 'OFIGAL'),
('OFICINA GENERAL DE BIENESTAR UNIVERSITARIO', 'Dependencia', 'OFIGBU'),
('OFICINA GENERAL DE COOPERACIÓN Y RELACIONES INTERINSTITUCIONALES', 'Dependencia', 'OGCRI'),
('OFICINA GENERAL DE ECONOMÍA', 'Dependencia', 'OFIGE'),
('OFICINA GENERAL DE GESTIÓN DEL RIESGO Y ADAPTACIÓN AL CAMBIO CLIMÁTICO', 'Dependencia', 'OGGRACC'),
('OFICINA GENERAL DE IMAGEN INSTITUCIONAL', 'Dependencia', 'OFIGII'),
('OFICINA GENERAL DE INFRAESTRUCTURA UNIVERSITARIA', 'Dependencia', 'OFIGIU'),
('OFICINA GENERAL DE PLANIFICACIÓN', 'Dependencia', 'OFIPLA'),
('OFICINA GENERAL DE RECURSOS HUMANOS (PERSONAL)', 'Dependencia', 'OFIGRE'),
('OFICINA GENERAL DE SERVICIOS GENERALES, OPERACIONES Y MANTENIMIENTO', 'Dependencia', 'OGSGOM'),
('ÓRGANO DE CONTROL INSTITUCIONAL', 'Dependencia', 'OCOIN'),
('RADIO Y TELEVISIÓN', 'Dependencia', 'RAYTE'),
('RECTORADO', 'Dependencia', 'RECTO');
-- UPDATE `directorio` SET `abreviatura` = 'RECT' WHERE `directorio`.`id` = 50;

-- Agregar Facultades
INSERT INTO directorio (nombre, tipo, abreviatura) VALUES
('FACULTAD DE CIENCIAS MATEMÁTICAS', 'Facultad', 'UNAP'),
('FACULTAD DE CIENCIAS ADMINISTRATIVAS', 'Facultad', 'UNAP');

DELIMITER //

CREATE PROCEDURE insertarDatos (
IN p_unidad VARCHAR(100),
IN p_cargo VARCHAR(100),
IN p_nombre VARCHAR(150),
IN p_apellido VARCHAR(100),
IN p_email VARCHAR(100)
)
BEGIN
	INSERT INTO datos(unidad, cargo, nombre, apellido, email)
    VALUES (p_unidad, p_cargo, p_nombre, p_apellido, p_email);
END //


DELIMITER ;

-- ALTER TABLE datos AUTO_INCREMENT=1;
-- ALTER TABLE directorio AUTO_INCREMENT=1;

-- SELECT * FROM datos;

-- DELETE FROM datos WHERE codigo=1;

/*
SELECT directorio.*, datos.*
FROM directorio
INNER JOIN datos ON directorio.id = datos.id_directorio;
*/
CALL insertarDatos('OTI','Practicante','Aldhair Maykol','Soriano Marquez','epoyedi88@gmail.com');


