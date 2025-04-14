
require('dotenv').config(); // Adicione esta linha no topo
const nodemailer = require('nodemailer');


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




exports.sendEmail = async (para) => { // Tornar async
    try {
        const mailOptions = {
            from: 'PHP-Hopper <' + process.env.EMAIL + '>',
            to: para,
            subject: 'Você fez login em nosso site !',
            html: '<h1>Muito obrigado</h1><p>Suas informações não foram salvas, este é somente um projeto feito para estudos.</p>',
        };
        const info = await transporter.sendMail(mailOptions);
        if(info){
            console.log('Email enviado com sucesso');
        }
        return info;
    } catch (error) {
        console.error('Falha no envio:', error.message);
        
    }
}