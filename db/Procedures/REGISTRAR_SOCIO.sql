DELIMITER //
DROP PROCEDURE IF EXISTS REGISTRAR_SOCIO //
CREATE PROCEDURE REGISTRAR_SOCIO(
	IN s_user VARCHAR(25),
	IN s_pass VARCHAR(20),
    IN s_nombre VARCHAR(45),
    IN s_apellido VARCHAR(50),
    IN s_direccion VARCHAR(70),
    IN s_telefono VARCHAR(15),
    IN s_email VARCHAR(45),
    OUT respuesta INT
)
COMMENT 'Da de alta un socio con un numero de afiliado único'
BEGIN
	-- Declaraciones
	DECLARE error_registro CONDITION FOR SQLSTATE '22012';
	DECLARE s_numafiliado INT DEFAULT 0; -- NUM_AFILIADO QUE SE OTORGA AL NUEVO USUARIO
    SET respuesta = 0;
    -- Validaciones
    SELECT IFNULL(MAX(num_afiliado)+1, 0) INTO s_numafiliado from socio;
    IF(s_numafiliado>0) THEN
		INSERT INTO socio (num_afiliado, user, pass, nombre, apellido, direccion, telefono, email)
		VALUES (s_numafiliado, s_user, s_pass, s_nombre, s_apellido, s_direccion, s_telefono, s_email);
        SET respuesta = 1;
	ELSE
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Error al dar de alta el socio';
	END IF;
END
//
DELIMITER ;