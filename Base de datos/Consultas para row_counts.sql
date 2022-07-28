USE treninterurbano;

SELECT * FROM tickets WHERE idCliente = 2;


SELECT * FROM tickets WHERE idCliente = 2 ORDER BY fechaC DESC LIMIT 0,5


SELECT * FROM facturas WHERE idCliente = 2 AND STATUS = 3

SELECT * FROM cliente WHERE email= "floresedwin942@gmail.com"