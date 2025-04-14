````markdown
================================================
FILE: README.md
================================================

# 📝 Sistema de CRUD com Mensageria (PHP + Node.js + RabbitMQ)

## 🌟 Visão Geral
Sistema de autenticação e CRUD com arquitetura distribuída, utilizando:
- **PHP** como produtor de mensagens (operações do sistema)
- **Node.js** como consumidor assíncrono (serviço de logs e e-mail)
- **RabbitMQ** como broker de mensagens

## 🚀 Principais Melhorias

### 🔄 Nova Integração com RabbitMQ
| Componente         | Função                                | Tecnologia            |
|--------------------|---------------------------------------|-----------------------|
| Producer (PHP)     | Envia logs de operações SQL          | php-amqplib v2.0.2    |
| Consumer (Node.js) | Grava logs em arquivo com timestamp e envia e-mail | amqplib 0.10.7        |
| Fila `log_sql`     | Canal de comunicação entre serviços   | RabbitMQ 3.12+        |

### 📊 Fluxo de Mensagens
```mermaid
graph LR
    A[PHP] -->|Publica mensagens| B[RabbitMQ]
    B -->|Consome mensagens| C[Node.js]
    C --> D[(Arquivo log.txt)]
    C --> E[(Envio de E-mail)]
````

## 🛠️ Configuração do Ambiente

### Pré-requisitos

```bash
# PHP
php >= 7.4
composer require php-amqplib/php-amqplib

# Node.js
node >= 16.x
npm install amqplib fs path dotenv nodemailer
```

### Como Executar

1.  **Inicie o RabbitMQ (via Docker)**:

    ```bash
    docker run -d -p 5672:5672 rabbitmq:3-management
    ```

    *Este comando inicia o RabbitMQ utilizando a imagem oficial `rabbitmq:3-management` do Docker, expondo a porta padrão 5672.*

2.  **Producer (PHP)**:

    ```bash
    php producer/src/views/teste.php
    ```

3.  **Consumer (Node.js)**:

    ```bash
    node consumer/consumer.js
    ```

## 📂 Estrutura Atualizada

```plaintext
projeto/
├── consumer/
│   ├── consumer.js          # Serviço de logs e e-mail
│   ├── logs/
│   │   └── sql/log.txt      # Logs das consultas SQL
│   ├── node_modules/
│   ├── package-lock.json
│   ├── package.json
│   ├── sendMail.js          # Módulo para envio de e-mails
│   └── .env                 # Arquivo de configuração de e-mail
├── producer/
│   ├── src/
│   │   ├── assets/
│   │   │   └── js/showPassword.js
│   │   ├── classes/
│   │   │   ├── events/Alert.php
│   │   │   ├── rabbitmq/Producer.php
│   │   │   ├── rdg/UserGateway.php
│   │   │   └── validation/ValidateUser.php
│   │   ├── database/
│   │   │   ├── database.db
│   │   │   └── tables.sql
│   │   └── services/
│   │       ├── processar_cadastro.php
│   │       ├── processar_login.php
│   │       ├── processar_logout.php
│   │       └── processar_update.php
│   │   └── views/
│   │       ├── index.php
│   │       ├── lista.php
│   │       ├── login.php
│   │       └── perfil.php
│   ├── composer.json
│   ├── composer.lock
│   ├── config.php
│   └── producer.php        # Exemplo básico de produtor (pode ser removido/alterado)
└── README.md
```

[⬆ Voltar ao topo](https://www.google.com/search?q=%23-sistema-de-crud-com-mensageria-php--nodejs--rabbitmq)

```
```