CREATE OR REPLACE VIEW V_CANCHAS_DETALLE AS
SELECT f.idfilial, f.localidad, num_cancha, deporte, categoria, f.horario_apertura, f.horario_cierre, f.diames_mantenimiento
FROM cancha c
JOIN filial f ON c.idfilial=f.idfilial
ORDER BY idfilial asc, deporte asc, num_cancha asc;