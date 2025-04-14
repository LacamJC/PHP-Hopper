
require('dotenv').config(); // Adicione esta linha no topo
const nodemailer = require('nodemailer');

exports.sendEmail = (para) => {
    const transporter = nodemailer.createTransport({
        host: 'smtp.gmail.com',
        port: 465,
        secure: true,
        auth: {
            user: process.env.EMAIL,
            pass: process.env.PASS

        }
    });
    // 2. Opções do e-mail
    const mailOptions = {
        from: 'Email automatico <'+process.env.EMAIL+'>',
        to: para,
        subject: 'Você fez login em nosso site !',
        html: '<h1>Muito obrigado</h1><p>Suas informações não foram salvas, este é somente um projeto feito para estudos.</p>',
    };

    // 3. Envio
    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.error('Erro:', error);
        } else {
            console.log('E-mail enviado:', info.response);
        }
    });
}

