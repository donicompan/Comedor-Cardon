USE empresa;

SELECT *
FROM empleados2;

-- para eliminar toda la tabla
truncate table empleados2;

-- para iliminar de uno
DELETE FROM empleados2
WHERE emp_id = 3;

-- para eliminar varias filas
DELETE FROM empleados2
WHERE emp_id IN (1,2);