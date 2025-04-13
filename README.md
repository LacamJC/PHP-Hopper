
# 📝 Sistema de CRUD com Mensageria (PHP + Node.js + RabbitMQ)

## 🌟 Visão Geral
Sistema de autenticação e CRUD com arquitetura distribuída, utilizando:
- **PHP** como produtor de mensagens (operações do sistema)
- **Node.js** como consumidor assíncrono (serviço de logs)
- **RabbitMQ** como broker de mensagens

## 🚀 Principais Melhorias

### 🔄 Nova Integração com RabbitMQ
| Componente       | Função                               | Tecnologia          |
|------------------|--------------------------------------|---------------------|
| Producer (PHP)   | Envia logs de operações SQL          | php-amqplib v2.12.0 |
| Consumer (Node)  | Grava logs em arquivo com timestamp  | amqplib 0.10.7      |
| Fila `log_sql`   | Canal de comunicação entre serviços  | RabbitMQ 3.12+      |

### 📊 Fluxo de Mensagens
```mermaid
graph LR
    A[PHP] -->|Publica mensagens| B[RabbitMQ]
    B -->|Consome mensagens| C[Node.js]
    C --> D[(Arquivo log.txt)]
```

## 🛠️ Configuração do Ambiente

### Pré-requisitos
```bash
# PHP
php >= 7.4
composer require php-amqplib/php-amqplib

# Node.js
node >= 16.x
npm install amqplib fs path
```

### Como Executar
1. **Inicie o RabbitMQ**:
    ```bash
    docker run -d -p 5672:5672 rabbitmq:3-management
    ```

2. **Producer (PHP)**:
    ```bash
    php producer/src/views/teste.php
    ```

3. **Consumer (Node)**:
    ```bash
    node consumer/consumer.js
    ```

## 📂 Estrutura Atualizada
```plaintext
projeto/
├── consumer/
│   ├── consumer.js         # Serviço de logs
│   ├── logs/
│   │   └── sql/log.txt     # Logs das consultas
├── producer/
│   ├── src/
│   │   ├── classes/
│   │   │   └── rabbitmq/   # Classe ProducerSQL
│   │   └── views/teste.php # Exemplo de uso
└── README.md
```






[⬆ Voltar ao topo](#-sistema-de-crud-com-mensageria-php--nodejs--rabbitmq)

