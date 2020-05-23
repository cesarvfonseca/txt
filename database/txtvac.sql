SELECT * FROM P1TXTVAC;
SELECT * FROM P1ACCESOWEB;

INSERT INTO P1ACCESOWEB (employee,password,last_login_datetime,counter_login,lupd_datetime,lupd_user) 
VALUES ('02144','6bfcc4026b5f162799a6dc8305c09db9c1674ac616bd5c7422a45fbb6d0816ac163047c47a1f426f4f4c6b5b5042c671eabc4fdc7310fd5b183eef59dc274604',GETDATE(),0,GETDATE(),'00001');

SELECT pe.employee,pe.emp_name,pe.emp_status,aw.password
FROM PJEMPLOY pe
INNER JOIN P1ACCESOWEB aw
ON pe.employee = aw.employee
WHERE pe.employee='02550'


SELECT
tipo,
CASE
	WHEN tipo = 1
	THEN SUM(horas)
END AS total_txt_favor, 
CASE
	WHEN tipo = 2
	THEN SUM(horas) 
END AS total_txt_contra,
CASE
	WHEN tipo = 3
	THEN SUM(dias) 
END AS total_vacaciones
FROM P1TXTVAC 
WHERE employee = '08444'
GROUP BY tipo;

SELECT * FROM P1TXTVAC WHERE employee='08444';
/*PANEL EMPLEADO*/
SELECT
employee,
fecha,
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
	id,
	tipo,
	horas,
	dias,
	emp_observaciones,
	jefe_observaciones,
	rh_observaciones
FROM P1TXTVAC ORDER BY fecha
/*PANEL JEFE*/
SELECT 
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
txt.employee,
txt.fecha,
txt.tipo,
txt.horas,
txt.dias,
txt.emp_observaciones,
txt.jefe_observaciones,
txt.rh_observaciones,
pe.emp_name
FROM P1TXTVAC txt
INNER JOIN PJEMPLOY pe
ON txt.employee = pe.employee
WHERE pe.manager1='02144' ORDER BY fecha ASC;

/*LOG DE JEFES*/
SELECT employee,emp_name,manager1,user1,em_id03, * FROM PJEMPLOY WHERE manager1='02551'
SELECT employee,emp_name,manager1,user1,em_id03, * FROM PJEMPLOY WHERE employee='02550'
/*
TRUNCATE TABLE [dbo].[P1TXTVAC]
*/
SELECT * FROM rh_empelados2 WHERE Planta = 'SISTEMAS'
SELECT * FROM empleado_puesto
SELECT * FROM puestos
SELECT employee,emp_name,manager1,user1,em_id03, * FROM PJEMPLOY WHERE employee = '21629' OR employee = '08444';
SELECT employee,emp_name,manager1,* FROM PJEMPLOY WHERE emp_name LIKE '%Ortega%' order by date_hired;
/*
//SOLICITUD EMPLEADO
INSERT INTO 
P1TXTVAC(employee,puesto,fecha,txt_favor,txt_contra,vac_solicitadas,vac_anio,emp_observaciones,jefe_autorizacion,jefe_observaciones,rh_vobo,rh_observaciones,crtd_user,lupd_datetime,lupd_user) 
VALUES('08444','P0007','2018-07-11',1,0,0,0,'Mantenimiento de equipos RH',0,'',0,'','08444',GETDATE(),'08444');

//AUTIRZACION JEFE
UPDATE P1TXTVAC 
SET
jefe_autorizacion = 1,
jefe_observaciones = 'Autorizado',
lupd_datetime = GETDATE(), 
lupd_user = '02144'
WHERE id=1;

//VOBO RH
UPDATE P1TXTVAC 
SET
rh_vobo = 1,
rh_observaciones = 'Aceptado',
lupd_datetime = GETDATE(), 
lupd_user = '12454'
WHERE id=1;

*/

/*

DROP TABLE [dbo].[P1TXTVAC]
DROP TABLE [dbo].[P1ACCESOWEB]
TRUNCATE TABLE [dbo].[P1TXTVAC]

*/

/*CREAR TABLA TIEMPO POR TIEMPO*/
USE [MEXQAppPr]
GO
/****** Object:  Table [dbo].[xmldata]    Script Date: 01/24/2017 08:30:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[P1TXTVAC](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[employee] [char](10) NOT NULL,
	[puesto] [char](50) DEFAULT '',
	[fecha] [DATE] NOT NULL,
	[tipo] [int] NOT NULL,
	[horas] decimal(5,1) DEFAULT 0.0,
	[dias] [int] DEFAULT 0,
	[vac_anio] [int] DEFAULT 0,
	[puntos_mexq] [int] DEFAULT 0,
	[emp_observaciones] [TEXT],
	[jefe_autorizacion] [int] DEFAULT 0,
	[jefe_observaciones] [TEXT] DEFAULT '',
	[rh_vobo] [int] DEFAULT 0,
	[rh_observaciones] [TEXT] DEFAULT '',
	[crtd_datetime] [datetime] default GETDATE(),
	[crtd_user] [char](10) NOT NULL,
	[lupd_datetime] [datetime] NOT NULL,
	[lupd_user] [char](10) NOT NULL
) ON [PRIMARY]
GO
/*CREAR TABLA*/

/*CREAR TABLA CONTROL DE ACCESO*/
USE [MEXQAppPr]
GO
/****** Object:  Table [dbo].[xmldata]    Script Date: 01/24/2017 08:30:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[P1ACCESOWEB](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[employee] [char](10) NOT NULL,
	[password] [text] NOT NULL,
	[last_login_datetime] [datetime] NOT NULL,
	[counter_login] [int] NOT NULL,
	[estado] [int] DEFAULT 0,
	[lupd_datetime] [datetime] NOT NULL,
	[lupd_user] [char](10) NOT NULL,
	[aux1] [char](50) DEFAULT '',
	[aux2] [text] DEFAULT '',
	[aux3] [datetime] DEFAULT '1900-01-01 00:00:00.000',
	[aux4] [int] DEFAULT 0
) ON [PRIMARY]
GO
/*CREAR TABLA*/

/*
CREAR TRIGGER 
	CADA VEZ QUE SE REALICE UN REGISTYR NUEVO A PJEMPLOY SE EJECUTARA EL TRIGGER SIGUIENTE HACIENDO UN REGISTRO
	EN LA TABLA DE P1ACCESOWEB, CREANDO UNA CONTRASE�A DEFAULT(P@ssw0rd) PARA EL EMPLEADO
*/
Create trigger trg_Actualizar_acceso_web
on PJEMPLOY
after insert
--,update
as
BEGIN
    set nocount on;
    declare
    @id_employee varchar(10)

    select @id_employee = employee 
    from inserted

    declare
    @password varchar (500),
	@last_login_datetime datetime,
    @counter int,
	@lupd_datetime datetime,
	@lupd_user char (10)

    set @password='6bfcc4026b5f162799a6dc8305c09db9c1674ac616bd5c7422a45fbb6d0816ac163047c47a1f426f4f4c6b5b5042c671eabc4fdc7310fd5b183eef59dc274604'
    set @last_login_datetime = '1900-01-01 00:00:00.000'
    set @counter = 0
    set @lupd_datetime = GETDATE()
    set @lupd_user = '00001'

    begin
        insert into P1ACCESOWEB (employee,password,last_login_datetime,counter_login,lupd_datetime,lupd_user)
		values(@id_employee,@password,@last_login_datetime,@counter,@lupd_datetime,@lupd_user )
    end
END
/*TRIGGER */

-- CREAR USUARIO NUEVO EN TURNOS
CREATE TRIGGER P1asignarTurno
ON tbempleados
FOR INSERT
	AS DECLARE  @NUMERO_NOMINA VARCHAR(5),
				@ID_SUCURSAL INT;
SELECT @NUMERO_NOMINA = ins.numero_nomina FROM INSERTED ins;
SELECT @ID_SUCURSAL = ins.id_sucursal FROM INSERTED ins;
IF @ID_SUCURSAL = 3
	BEGIN
		INSERT INTO P1TurnoUsuario (numero_nomina,created_at,created_by) VALUES ( @NUMERO_NOMINA,GETDATE(),'00001')
	END
GO