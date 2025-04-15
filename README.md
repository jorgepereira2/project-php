## Setup via Docker
```bash
composer install
```
```bash
Restaure o arquivo 'avaliacao.sql' em seu banco de dados MySQL
```
```bash
Configure o arquivo .env com os dados do banco local
```

## Rota pública

Responsável pela abertura do site

/


## Rotas privadas

Responsável pelo login e geração do Token usado nas demais chamadas da API.

```bash
/login
```


Responsável pelo inicio do aquecimento.

```bash
/api/aquecimento
```


Responsável pela listagem dos programas.

```bash
/api/aquecimento/programa
```


Responsável pela criação do programa.

```bash
/api/aquecimento/programa/store
```


Responsável pela exclusão do programa.

```bash
/api/aquecimento/programa/{id}/delete
```

## Credenciais
```bash
- E-mail: jorge.pereira@email.com
- Senha: JORGE123
- Hash: JJS (JJS+Senha)
```
