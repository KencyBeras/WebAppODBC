DELIMITER //
DROP PROCEDURE IF EXISTS CANCELAR_CANCHA //
CREATE PROCEDURE CANCELAR_CANCHA(
	IN r_idturno INT,
    OUT respuesta INT
)
COMMENT 'Da de baja un turno en una filial y cancha determinada'
BEGIN
	-- Declaraciones
	DECLARE error_cancelar CONDITION FOR SQLSTATE '22015';
    DECLARE existe_turno INT DEFAULT 0; -- Guarda el id del turno determinado y si no exist guarda un 0
    DECLARE fechaturnodif DATETIME; -- Guarda la fecha del turno determinado y se le restan 2 horas
    DECLARE fechaactual DATETIME; -- Es la fecha en la que quiero realizar la baja del turno
    SET respuesta:=0;
    -- Validaciones
    SELECT IFNULL(SUM(t.idturno), 0) INTO existe_turno FROM turno t WHERE t.idturno=r_idturno;
    SELECT NOW() INTO fechaactual;
    
    IF(existe_turno!=0) THEN
		SELECT DATE_SUB(t.fechahora, INTERVAL 2 HOUR) INTO fechaturnodif FROM turno t WHERE t.idturno=r_idturno; #Extraigo la fecha del turno y le resto 2 horas para validar
		IF(fechaturnodif>fechaactual) THEN
			UPDATE turno t SET t.estado='cancelada' WHERE t.idturno=r_idturno; #el estado de la cancha pasa a ser 'cancelada' en lugar de 'reservada'
            SET respuesta = ROW_COUNT();
            SELECT respuesta;
		ELSE
			SET respuesta:=0;
            SELECT respuesta;
			SIGNAL SQLSTATE '22015'
			SET MESSAGE_TEXT = 'Error al cancelar reserva: debe cancelarse con menos de 2 horas de anticipación';
        END IF;
	END IF;
    
COMMIT;
END
//
DELIMITER ;