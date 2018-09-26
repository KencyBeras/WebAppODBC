DELIMITER //
DROP PROCEDURE IF EXISTS RESERVAR_CANCHA //
CREATE PROCEDURE RESERVAR_CANCHA(
	IN r_idFilial INT,
	IN r_numcancha INT,
    IN r_deporte VARCHAR(45),
    IN r_numafiliado INT,
    IN r_fechahora DATETIME,
    OUT respuesta INT
)
COMMENT 'Da de alta un turno en una filial y cancha determinada'
BEGIN
	-- Declaraciones
	DECLARE error_reserva CONDITION FOR SQLSTATE '22013';
    DECLARE r_idcancha INT DEFAULT 0;
    DECLARE r_idsocio INT DEFAULT 0;
    DECLARE fechahora_valida BOOLEAN DEFAULT 0; -- Si no se está sobre el día de mantenimiento la cancha está abierta a esa hora
    DECLARE turno_existente BOOLEAN DEFAULT 0; -- Para saber que no exista un turno activo en esa cancha a esa hora
    DECLARE fecha_actual DATETIME DEFAULT NOW(); -- Fecha de hoy
    -- Validaciones
    SELECT IFNULL(SUM(c.idcancha), 0) INTO r_idcancha FROM cancha c WHERE c.idfilial=r_idfilial AND c.num_cancha=r_numcancha AND c.deporte=r_deporte;
    SELECT IFNULL(SUM(s.idsocio), 0) INTO r_idsocio FROM socio s WHERE s.num_afiliado=r_numafiliado;
    
    IF(r_idfilial>0 AND r_idcancha>0 AND r_idsocio>0) THEN
		SELECT IFNULL(SUM(1), 0) INTO fechahora_valida-- Si encuentra cancha retorna 1, sino 0 
		FROM V_CANCHAS_DETALLE
		WHERE idfilial=r_idfilial AND num_cancha=r_numcancha AND deporte=r_deporte
		AND (TIME(r_fechahora) between horario_apertura AND horario_cierre)
        AND (DAY(r_fechahora) != diames_mantenimiento);
        IF(fechahora_valida AND r_fechahora>fecha_actual) THEN
			SELECT IFNULL(SUM(1), 0) INTO turno_existente FROM turno WHERE idcancha=r_idcancha AND fechahora=r_fechahora AND estado = 'reservada';
            IF(!turno_existente) THEN -- Se puede reservar la cancha correctamente
				INSERT INTO turno (idfilial, idcancha, idsocio, fechahora, estado)
				VALUES (r_idfilial, r_idcancha, r_idsocio, r_fechahora, 'reservada');
				SET respuesta = ROW_COUNT();
			ELSE
            SIGNAL SQLSTATE '22014'
			SET MESSAGE_TEXT = 'Error al reservar la cancha: ya existe una reserva activa';
            END IF;
		END IF;
	ELSE
		SIGNAL SQLSTATE '22013'
		SET MESSAGE_TEXT = 'Error al reservar la cancha: datos invalidos';
	END IF;
    
COMMIT;
END
//
DELIMITER ;