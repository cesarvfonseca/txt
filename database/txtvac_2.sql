SELECT te.numero_nomina,te.nombre_largo,tc.nombre AS Departamento,jl.fecha,
CASE 
	WHEN (SELECT hora_entrada_omision FROM P1Ausentismo WHERE numero_nomina = te.numero_nomina AND fecha_omision = jl.fecha) <> NULL
	THEN (SELECT hora_entrada_omision FROM P1Ausentismo WHERE numero_nomina = te.numero_nomina AND fecha_omision = jl.fecha)
	ELSE jl.horaentrada
END AS horaEntrada,
(SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 7) as herh,
CASE 
	WHEN (SELECT hora_salida_omision FROM P1Ausentismo WHERE numero_nomina = te.numero_nomina AND fecha_omision = jl.fecha) <> NULL
	THEN (SELECT hora_salida_omision FROM P1Ausentismo WHERE numero_nomina = te.numero_nomina AND fecha_omision = jl.fecha)
	ELSE jl.horasalida
END AS horaSalida,
(SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 8) as hsrh,
CASE
	WHEN (SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 7) IS NOT NULL AND (SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 8) IS NOT NULL
	THEN DATEDIFF(MINUTE,(SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 7),(SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 8))
	WHEN (SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 7) IS NOT NULL AND (SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 8) IS NULL
	THEN DATEDIFF(MINUTE,(SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 7),jl.horasalida)
	WHEN (SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 7) IS NULL AND (SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 8) IS NOT NULL
	THEN DATEDIFF(MINUTE,jl.horaentrada,(SELECT puesto FROM P1TXTVAC WHERE employee = te.numero_nomina AND fecha = jl.fecha AND tipo = 8))
	ELSE DATEDIFF(MINUTE,jl.horaentrada,jl.horasalida)
END AS jorndaLaboral			
FROM tbempleados AS te
INNER JOIN jornadaLaboral AS jl
ON jl.numero_nomina  LIKE '%'+te.numero_nomina
INNER JOIN tbcelula AS tc
ON tc.id_celula = te.id_celula
AND jl.fecha >= '2020-02-10' AND jl.fecha <= '2020-02-14'

				SELECT name,
       type,*
  FROM dbo.sysobjects
 WHERE (type = 'P')
 order by crdate asc

 sp_helptext 'P1omisionES'

exec P1omisionES '2020-03-08','19905','20:00','TEST',8
SELECT * FROM P1TXTVAC order by id desc

INSERT INTO P1TXTVAC(employee,puesto,fecha,tipo,rh_vobo,rh_observaciones,crtd_datetime,crtd_user,lupd_user)
VALUES ('19905','20:00','2020-03-08',7,1,'test',GETDATE(),'P1001','P1001')

ALTER PROCEDURE P1omisionES
(
@FECHA DATE,
@NUMERO_NOMINA VARCHAR(5),
@HORA VARCHAR(5),
@COMENTARIORH VARCHAR(50),
@TIPO INT
)
AS BEGIN TRY
	BEGIN TRANSACTION
	IF (@TIPO = 200)
		BEGIN
			PRINT 'Borrar'
			DELETE FROM P1TXTVAC WHERE employee = @NUMERO_NOMINA AND fecha = @FECHA AND tipo = @COMENTARIORH
		END
	ELSE IF (NOT EXISTS(SELECT * FROM P1TXTVAC WHERE employee = @NUMERO_NOMINA AND fecha = @FECHA AND tipo = @TIPO))
		 BEGIN
			INSERT INTO P1TXTVAC(employee,puesto,fecha,tipo,rh_vobo,rh_observaciones,crtd_datetime,crtd_user,lupd_datetime,lupd_user)
			VALUES (@NUMERO_NOMINA,@HORA,@FECHA,@TIPO,1,@COMENTARIORH,GETDATE(),'P1001',GETDATE(),'P1001')
			--print 'column not exists'
		 END
		 ELSE
		 BEGIN
			UPDATE P1TXTVAC SET puesto = @HORA, rh_observaciones = @COMENTARIORH, crtd_datetime = GETDATE() WHERE employee = @NUMERO_NOMINA AND fecha = @FECHA AND tipo = @TIPO
			--print 'column already exists'
		 END
		 COMMIT
 END TRY
 BEGIN CATCH
  ROLLBACK
 END CATCH