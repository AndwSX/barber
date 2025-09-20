const express = require("express");
const cors = require("cors");
const nodemailer = require("nodemailer");

const app = express();
app.use(cors());
app.use(express.json());

// Configuración del transporte de correo
const transporter = nodemailer.createTransport({
  service: "gmail",
  auth: {
    user: "nominasena793@gmail.com", // tu correo
    pass: "zlwp jisw lsfz sskz",     // contraseña de aplicación
  },
});

// Ruta de prueba
app.get("/", (req, res) => {
  res.send("🚀 Servidor funcionando correctamente!");
});

// Ruta para reservar cita y enviar correo
app.post("/reservar", async (req, res) => {
  const { nombre, correo, fecha, hora, servicio } = req.body;

  // Validación de datos
  if (!nombre || !correo || !fecha || !hora || !servicio) {
    return res.status(400).json({
      success: false,
      message: "Faltan datos de la reserva ❌",
    });
  }

  try {
    // Enviar correo de confirmación
    await transporter.sendMail({
      from: "nominasena793@gmail.com",
      to: correo,
      subject: "Confirmación de tu cita en Style Barber",
      html: `
        <h2>Hola ${nombre}!</h2>
        <p>Tu cita ha sido agendada correctamente.</p>
        <ul>
          <li><strong>Servicio:</strong> ${servicio}</li>
          <li><strong>Fecha:</strong> ${fecha}</li>
          <li><strong>Hora:</strong> ${hora}</li>
        </ul>
        <p>¡Te esperamos en Style Barber!</p>
      `,
    });

    res.json({
      success: true,
      message: "Reserva creada y correo enviado ✅",
    });
  } catch (error) {
    console.error("Error enviando correo:", error);
    res.status(500).json({
      success: false,
      message: "Error enviando correo ❌",
    });
  }
});

// Puerto
app.listen(5000, () => {
  console.log("🚀 Servidor corriendo en http://localhost:5000");
});




