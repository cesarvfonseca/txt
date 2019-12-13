SELECT * FROM P1TXTVAC WHERE employee = '19905'
SELECT * FROM tbempleados WHERE id_sucursal = 3 AND status <> 'B'
SELECT * FROM PJEMPLOY WHERE employee = '19905'
UPDATE PJEMPLOY SET manager1 = '08444' WHERE employee = '19905'
UPDATE PJEMPLOY SET emp_status = 'A' WHERE employee = '08444'

SELECT 
pin,cast(checktime as time(0)),
MAX(cast(checktime as time(0))),MIN(cast(checktime as time(0)))
FROM checkinout 
WHERE pin LIKE '%19905' 
GROUP BY checktime,pin ORDER BY checktime DESC


ALTER VIEW jornadaLaboral
AS
SELECT pin AS numero_nomina,CONVERT(date,checktime) as fecha, MIN(CONVERT(time,checktime)) as horaentrada, MAX(CONVERT(time,checktime)) as horasalida,
DATEDIFF(N,MIN(checktime),MAX(checktime))  AS JL
from checkinout
group by CONVERT(date,checktime),pin

SELECT * FROM jornadaLaboral where numero_nomina = '000019905' order by fecha DESC

EXEC p1solicitudRHRango '2018-08-14','2019-08-14'
EXEC p1solicitudRHRango '19905','2019-05-01','2019-10-28'

CREATE PROCEDURE p1solicitudEmpleado
    @numero_nomina nvarchar(5),
    @fecha_ini DATE,
    @fecha_fin DATE
AS  
BEGIN  
	SET NOCOUNT ON; 
	SELECT
	employee,
	te.nombre_largo,
	(SELECT horaentrada FROM jornadaLaboral WHERE numero_nomina LIKE '%'+@numero_nomina AND fecha = pt.fecha) AS horaEntrada,
	(SELECT horasalida FROM jornadaLaboral WHERE numero_nomina LIKE '%'+@numero_nomina AND fecha = pt.fecha) AS horaSalida,
	(SELECT JL FROM jornadaLaboral WHERE numero_nomina LIKE '%'+@numero_nomina AND fecha = pt.fecha) AS jornada,
	CASE
		WHEN tipo = 1
		THEN 'TXT A FAVOR'
		WHEN tipo = 2
		THEN 'TXT EN CONTRA'
		WHEN tipo = 3
		THEN 'VACACIONES'
		END AS tipo_incidencia,
	CASE
		WHEN jefe_autorizacion=0
			THEN 'Pendiente'
		WHEN jefe_autorizacion=1
			THEN 'Autorizado'
		ELSE 'No Autorizado'
	END as voboJefe,
	CASE
		WHEN rh_vobo=0
			THEN 'Pendiente'
		WHEN rh_vobo=1
			THEN 'Autorizado'
		ELSE 'No Autorizado'
	END as voboRH,
		pt.fecha,
		jefe_autorizacion,
		rh_vobo,
		id,
		tipo,
		horas,
		dias,
		emp_observaciones,
		jefe_observaciones,
		rh_observaciones
	FROM P1TXTVAC AS pt
	INNER JOIN tbempleados AS te
	ON te.numero_nomina = REPLACE(pt.employee,' ','')
	WHERE employee = @numero_nomina AND fecha >= @fecha_ini AND fecha <= @fecha_fin
	ORDER BY lupd_datetime
END 
GO

EXEC p1solicitudJefe '02144','2019-10-01','2019-10-28'
UPDATE P1TXTVAC SET jefe_autorizacion = 0, jefe_observaciones = '' WHERE id = 2216

CREATE PROCEDURE p1solicitudJefe
    @numero_nomina nvarchar(5),
    @fecha_ini DATE,
    @fecha_fin DATE
AS  
BEGIN  
	SET NOCOUNT ON; 
SELECT
	pt.employee,
	te.nombre_largo,
	(SELECT horaentrada FROM jornadaLaboral WHERE numero_nomina LIKE '%'+REPLACE(pt.employee,' ','') AND fecha = pt.fecha) AS horaEntrada,
	(SELECT horasalida FROM jornadaLaboral WHERE numero_nomina LIKE '%'+REPLACE(pt.employee,' ','') AND fecha = pt.fecha) AS horaSalida,
	(SELECT JL FROM jornadaLaboral WHERE numero_nomina LIKE '%'+REPLACE(pt.employee,' ','') AND fecha = pt.fecha) AS jornada,
	CASE
		WHEN tipo = 1
		THEN 'TXT A FAVOR'
		WHEN tipo = 2
		THEN 'TXT EN CONTRA'
		WHEN tipo = 3
		THEN 'VACACIONES'
		END AS tipo_incidencia,
	CASE
		WHEN jefe_autorizacion=0
			THEN 'Pendiente'
		WHEN jefe_autorizacion=1
			THEN 'Autorizado'
		ELSE 'No Autorizado'
	END as voboJefe,
	CASE
		WHEN rh_vobo=0
			THEN 'Pendiente'
		WHEN rh_vobo=1
			THEN 'Autorizado'
		ELSE 'No Autorizado'
	END as voboRH,
		pt.fecha,
		id,
		tipo,
		horas,
		dias,
		jefe_autorizacion,
		rh_vobo,
		emp_observaciones,
		jefe_observaciones,
		rh_observaciones
	FROM P1TXTVAC AS pt
	INNER JOIN PJEMPLOY pe
	ON pt.employee = pe.employee
	INNER JOIN tbempleados AS te
	ON te.numero_nomina = REPLACE(pe.employee,' ','')
	WHERE pe.manager1 = @numero_nomina AND fecha >= @fecha_ini AND fecha <= @fecha_fin
	ORDER BY pt.lupd_datetime
END 
GO

CREATE PROCEDURE [dbo].[p1solicitudRHRango]
    @fecha_ini DATE,
    @fecha_fin DATE
AS  
BEGIN  
SET NOCOUNT ON; 
SELECT 
(SELECT horaentrada FROM jornadaLaboral WHERE numero_nomina LIKE '%'+te.numero_nomina AND fecha = txt.fecha) AS horaEntrada,
(SELECT horasalida FROM jornadaLaboral WHERE numero_nomina LIKE '%'+te.numero_nomina AND fecha = txt.fecha) AS horaSalida,
(SELECT JL FROM jornadaLaboral WHERE numero_nomina LIKE '%'+te.numero_nomina AND fecha = txt.fecha) AS jornada,
CASE
	WHEN tipo = 1
	THEN 'TXT A FAVOR'
	WHEN tipo = 2
	THEN 'TXT EN CONTRA'
	WHEN tipo = 3
	THEN 'VACACIONES'
	END AS tipo_incidencia,
jefe_autorizacion,
	CASE
		WHEN jefe_autorizacion=0
			THEN 'Pendiente'
		WHEN jefe_autorizacion=1
			THEN 'Autorizado'	
		ELSE 'No Autorizado'
	END as voboJefe,
rh_vobo,
	CASE
		WHEN rh_vobo=0
			THEN 'Pendiente'
		WHEN rh_vobo=1
			THEN 'Autorizado'
		ELSE 'No Autorizado'
	END as voboRH,
txt.id,
txt.jefe_autorizacion,
txt.employee,
txt.fecha,
txt.tipo,
txt.horas,
txt.dias,
txt.emp_observaciones,
txt.jefe_observaciones,
txt.rh_observaciones,
txt.rh_vobo,
te.nombre_largo,
tc.nombre AS departamento
FROM P1TXTVAC txt
INNER JOIN tbempleados AS te
ON te.numero_nomina = REPLACE(txt.employee,' ','')
INNER JOIN tbcelula tc
ON tc.id_celula = te.id_celula
WHERE fecha >= @fecha_ini AND fecha <= @fecha_fin AND jefe_autorizacion<>0;
END

CREATE PROCEDURE [dbo].[p1solicitudRHParametro]
	@parametro nvarchar(45),
    @fecha_ini DATE,
    @fecha_fin DATE
AS  
BEGIN  
SET NOCOUNT ON; 
SELECT 
(SELECT horaentrada FROM jornadaLaboral WHERE numero_nomina LIKE '%'+te.numero_nomina AND fecha = txt.fecha) AS horaEntrada,
(SELECT horasalida FROM jornadaLaboral WHERE numero_nomina LIKE '%'+te.numero_nomina AND fecha = txt.fecha) AS horaSalida,
(SELECT JL FROM jornadaLaboral WHERE numero_nomina LIKE '%'+te.numero_nomina AND fecha = txt.fecha) AS jornada,
CASE
	WHEN tipo = 1
	THEN 'TXT A FAVOR'
	WHEN tipo = 2
	THEN 'TXT EN CONTRA'
	WHEN tipo = 3
	THEN 'VACACIONES'
	END AS tipo_incidencia,
jefe_autorizacion,
	CASE
		WHEN jefe_autorizacion=0
			THEN 'Pendiente'
		WHEN jefe_autorizacion=1
			THEN 'Autorizado'	
		ELSE 'No Autorizado'
	END as voboJefe,
rh_vobo,
	CASE
		WHEN rh_vobo=0
			THEN 'Pendiente'
		WHEN rh_vobo=1
			THEN 'Autorizado'
		ELSE 'No Autorizado'
	END as voboRH,
txt.id,
txt.jefe_autorizacion,
txt.employee,
txt.fecha,
txt.tipo,
txt.horas,
txt.dias,
txt.emp_observaciones,
txt.jefe_observaciones,
txt.rh_observaciones,
txt.rh_vobo,
te.nombre_largo,
tc.nombre AS departamento
FROM P1TXTVAC txt
INNER JOIN tbempleados AS te
ON te.numero_nomina = REPLACE(txt.employee,' ','')
INNER JOIN tbcelula tc
ON tc.id_celula = te.id_celula
WHERE fecha >= @fecha_ini AND fecha <= @fecha_fin AND jefe_autorizacion<>0 AND (te.nombre_largo LIKE '%' + CONVERT(NVARCHAR, @parametro) + '%' OR te.numero_nomina LIKE '%' + CONVERT(NVARCHAR, @parametro) + '%' OR tc.nombre LIKE '%' + CONVERT(NVARCHAR, @parametro) + '%');
END
		