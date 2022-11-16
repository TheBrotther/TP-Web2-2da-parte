# TP-Web2-2da-parte
2da parte del trabajo especial de la materia Web2



ENDPOINTS CLIENT (categoria)

(GET) /api/clients
Devuelve todos los clientes.

(POST) /api/clients
Agrega un cliente pasandole un JSON en el body de la request.


Ejemplo:
     {  
     
        "dni": "41691037",  
        "alias": Gaspacho,  
        "city": Tandil  
        
     }
     
(GET) /api/clients/:ID
Devuelve la informacion del cliente con la id ingresada.

(DELETE) /api/clients/:ID
Borra la informacion del cliente con la id ingresada.

(PUT) /api/clients/:ID
Modifica los datos del cliente con la id ingresada, se debe pasar un JSON como body de la request.

Ejemplo:
     { 
     
        "dni": "41623123",  
        "alias": "Carreto",  
        "city": "Gesell"  
        
     }
     
     
     
     
     
ENPOINTS ACCOUNT (Item)

(GET) /api/accounts
Devuelve todas las cuentas.

(POST) /api/accounts
Agrega una cuenta pasandole un JSON en el body de la request.


Ejemplo:
     {   
     
        "amount": "3000000",  
        "type_account": "Caja de ahorro",  
        "coin": "Dolar" 
        
     }
     
(GET) /api/accounts/:ID
Devuelve la informacion de la cuenta con la id ingresada.

(DELETE) /api/accounts/:ID
Borra la informacion de la cuenta con la id ingresada.

(PUT) /api/accounts/:ID
Modifica los datos de la cuenta con la id ingresada, se debe pasar un JSON como body de la request.

Ejemplo:
     { 
     
        "amount": "100000000",  
        "type_account": "Plazo fijo",  
        "coin": "Peso"
        
     }

