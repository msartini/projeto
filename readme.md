## Projeto Laravel API Comercial
Projeto feito em Laravel. CRUD de Usuários, Produtos, Categorias de Produtos, Vendas, Estoque

- Baixar o projeto.
- Na pasta do projeto, executar ``` composer install ```
- Executar ``` cp .env.example .env ```
- Executar ``` php artisan key:generate ```
- Executar ``` composer dumpautoload ```
- Verificar as configurações de conexão com o banco no .env
  - **(Criar o banco e alterar o usuário do banco no _.env_ se necessário)**
  - **Configurar Host, Porta e as demais configurações de conexão com o banco**
- Executar ``` php artisan migrate ```
- Executar ``` php artisan db:seed```

#API Doc

## No Header do Postman
- Enviar : Content-type: application/json

## Em todos os endpoints, para consultar(GET), pode ser usado os seguintes parâmetros para todos os endpoints:
- Exemplo:
- - /api/produtos?like=name,tador  , onde name é o nome do campo e [ tador ] é parte da palavra a ser encontrada no campo name.
- - /api/produtos?where[category_id]=8, onde category_id é o nome do campo e [ 8 ] é o valor do campo
- - /api/produtos?limit=3, onde limit é a variavel de paginação e [ 3 ] é a quantidade de registros por página. O default é 15
- - /api/produtos?order=name,asc  , onde name é o campo a ser ordenado e [ asc ou desc ] é o sentido da ordenação (ascendente ou descendente)


## Categorias (Listagem)
- GET (/api/categorias) [Listar todos] ou (/api/categorias/{id}) [Exibir somente um registro], mesma regra para todos os endpoints.
- - Exemplo da listagem
```
{
    "current_page": 1,
    "data": [
        {
            "id": 8,
            "name": "Moda",
            "created_at": "2019-03-14 16:05:16",
            "updated_at": "2019-03-14 16:05:16"
        },
        {
            "id": 6,
            "name": "Jardinagem",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 5,
            "name": "Games",
            "created_at": null,
            "updated_at": null
        }
    ],
    "first_page_url": "http://comercial.test/api/categorias?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://comercial.test/api/categorias?page=3",
    "next_page_url": "http://comercial.test/api/categorias?page=2",
    "path": "http://comercial.test/api/categorias",
    "per_page": "3",
    "prev_page_url": null,
    "to": 3,
    "total": 9
}
```


- POST (/api/categorias)
- - Corpo para envio dos dados
```
{
	"name": "Moda"
}
```

- PUT (/api/categorias/{id})
- -  Exemplo do corpo:
```
{
	"name": "Moda Jovem"
}
```

- DELETE (/api/categorias/{id})

## Produtos (listagem)
- GET (/api/produtos)
- - Exemplo da listagem
```
{
    "current_page": 1,
    "data": [
        {
            "id": 3,
            "category_id": 8,
            "name": "Camisa Branca Tam.G",
            "stock": 200,
            "created_at": "2019-03-14 19:25:48",
            "updated_at": "2019-03-14 19:25:48",
            "category": {
                "id": 8,
                "name": "Moda",
                "created_at": "2019-03-14 16:05:16",
                "updated_at": "2019-03-14 16:05:16"
            }
        },
        {
            "id": 2,
            "category_id": 3,
            "name": "Computador Dell 32mb",
            "stock": 50,
            "created_at": "2019-03-14 18:21:15",
            "updated_at": "2019-03-14 18:25:12",
            "category": {
                "id": 3,
                "name": "Computadores",
                "created_at": null,
                "updated_at": null
            }
        },
        {
            "id": 1,
            "category_id": 3,
            "name": "Computador HP HD 1T",
            "stock": 100,
            "created_at": "2019-03-14 17:54:42",
            "updated_at": "2019-03-14 17:54:42",
            "category": {
                "id": 3,
                "name": "Computadores",
                "created_at": null,
                "updated_at": null
            }
        }
    ],
    "first_page_url": "http://comercial.test/api/produtos?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://comercial.test/api/produtos?page=1",
    "next_page_url": null,
    "path": "http://comercial.test/api/produtos",
    "per_page": 15,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
```

- POST ('api/produtos)
- - Exemplo do corpo
```
{
	"name": "Computador HP HD 1T",
	"stock": 200
}
```

- PUT ('api/produtos/{id})
- - Exemplo do corpo
```
	"name": "Computador Samsumg SSD 40mb",
```

- DELETE ('api/produtos/{id})

## Pedidos (Listagem)
- GET (/api/pedidos)
- - Exemplo da listagem
```
 {
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "product_id": 2,
            "quantity": 2,
            "user_id": 1,
            "created_at": "2019-03-14 18:59:36",
            "updated_at": "2019-03-14 18:59:36",
            "doc_number": 2000,
            "user": {
                "id": 1,
                "name": "Marcio",
                "email": "msartini@gmail.com",
                "email_verified_at": null,
                "created_at": null,
                "updated_at": null
            },
            "product": {
                "id": 2,
                "category_id": 3,
                "name": "Computador Dell 32mb",
                "stock": 50,
                "created_at": "2019-03-14 18:21:15",
                "updated_at": "2019-03-14 18:25:12"
            }
        },
        {
            "id": 2,
            "product_id": 1,
            "quantity": 4,
            "user_id": 1,
            "created_at": "2019-03-14 19:06:30",
            "updated_at": "2019-03-14 19:06:30",
            "doc_number": 2000,
            "user": {
                "id": 1,
                "name": "Marcio",
                "email": "msartini@gmail.com",
                "email_verified_at": null,
                "created_at": null,
                "updated_at": null
            },
            "product": {
                "id": 1,
                "category_id": 3,
                "name": "Computador HP HD 1T",
                "stock": 100,
                "created_at": "2019-03-14 17:54:42",
                "updated_at": "2019-03-14 17:54:42"
            }
        },
        {
            "id": 3,
            "product_id": 3,
            "quantity": 9,
            "user_id": 1,
            "created_at": "2019-03-14 19:27:26",
            "updated_at": "2019-03-14 19:27:26",
            "doc_number": 2000,
            "user": {
                "id": 1,
                "name": "Marcio",
                "email": "msartini@gmail.com",
                "email_verified_at": null,
                "created_at": null,
                "updated_at": null
            },
            "product": {
                "id": 3,
                "category_id": 8,
                "name": "Camisa Branca Tam.G",
                "stock": 200,
                "created_at": "2019-03-14 19:25:48",
                "updated_at": "2019-03-14 19:25:48"
            }
        }
    ],
    "first_page_url": "http://comercial.test/api/pedidos?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://comercial.test/api/pedidos?page=1",
    "next_page_url": null,
    "path": "http://comercial.test/api/pedidos",
    "per_page": 15,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
```
- POST (/api/pedidos)
- - Enviar como corpo (número de documento, como se fosse um número de nota; ID do Produto; ID do Usuário; Quantidade vendida)
```
{
	"doc_number": 2000,
	"product_id": 1,
	"user_id": 3,
	"quantity": 9
}
```

- DELETE (/api/pedidos/{id})
- - Method: Delete

- PUT (/api/pedidos/{id})
- - Informar no body os campos que devem ser alterados
```
{
	"doc_number": 2000,
	"product_id": 1,
	"user_id": 3,
	"quantity": 9
}
```

##Para forçar um *ERRO* em um POST de ORDERS.
- POST (/api/pedidos)
- Enviando uma string em alguns campos.
```
{
	"doc_number": 2000,
	"product_id": "teste",
	"user_id": "teste",
	"quantity": "valor"
}
```