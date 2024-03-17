# Desafio Full Stack
O projeto está divido com a seguinte estrutura

```
desafio-fullstack
|─── docker
│   └─── development
|    │   └─── php
|    │       │   Dockerfile
|    │   └─── node
|    │       │   Dockerfile
|    │   └─── nginx
|    │       │   default.conf
└─── backend (Laravel v10)
└─── frontend (Vue 3)
│   .env.example
│   .gitignore
│   docker-compose.yml
```

Ao rodar o comando `docker compose up -d`, todos os serviços serão iniciados, entretando, é necessário que adicione as seguinte linhas no arquivo de hosts.

```
127.0.0.1	desafio.local
127.0.0.1	backend.desafio.local
```

### Database Schema
<img src="schema-database-desafio-fullstack.png" title="Schema Database Mysql" alt="Schema Database Mysql" data-align="center">
