const amqp = require('amqplib');
const path = require("path");
const fs = require("fs");
const { sendEmail } = require('./sendMail');
const rabbitmqHost = process.env.RABBITMQ_HOST || 'rabbitmq'; 
async function startConsumer() {
    try {
        // 1. Conecta ao RabbitMQ
        const connection = await amqp.connect(`amqp://${rabbitmqHost}`);
        const channel = await connection.createChannel();

        // 2. Declara a fila (mesmo nome usado no PHP)
        const queue = 'log_sql';
        await channel.assertQueue(queue, { durable: false });

        console.log(' [*] Aguardando mensagens. Para sair pressione CTRL+C');

        // 3. Configura o consumidor
        channel.consume(queue, (message) => {
            if (message !== null) {
                console.log(' [x] Recebido: %s', message.content.toString());
                createLog(message.content.toString());
                sendEmail(message.content.toString());
                channel.ack(message); // Confirma o processamento
            }
        });


    } catch (error) {
        console.error('Erro:', error);
    }
}

async function createLog(msg) {
    let date = new Date()
    const filePath = path.join(__dirname, './logs/sql/log.txt');
    fs.appendFile(filePath, `${msg} - ${formatarDataHora()} \n`, (err) => {
        if (err){
            console.log('erro ao criar log');
        };
        
    })
}

function formatarDataHora() {
    const data = new Date();

    // Extrai horas e minutos (com zero à esquerda se necessário)
    const horas = String(data.getHours()).padStart(2, '0');
    const minutos = String(data.getMinutes()).padStart(2, '0');
    const seconds = String(data.getSeconds()).padStart(2, '0');

    // Extrai dia, mês e ano (com zero à esquerda para dia e mês)
    const dia = String(data.getDate()).padStart(2, '0');
    const mes = String(data.getMonth() + 1).padStart(2, '0'); // Mês começa em 0 (janeiro = 0)
    const ano = data.getFullYear();

    // Formata no padrão HH:MM DD-MM-YYYY
    return `${horas}:${minutos}:${seconds} ${dia}-${mes}-${ano}`;
}


startConsumer();