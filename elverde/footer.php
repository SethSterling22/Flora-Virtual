<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/footer_styles.css">

<footer>
    <section class="grid-footer-container">
        <div class="left-footer-item">
            <div class="catec-footer">
                <h2> Catec </h2>
                <p>CATEC es un agente catalizador en el desarrollo de la educación e investigación ecológica de la Universidad de Puerto Rico. Nuestra misión es proporcionar adiestramiento a estudiantes subgraduados, graduados y posdoctorales; llevar a cabo investigaciones relacionadas en las áreas de ecología, ambiental y biología de la conservación; mejorar la infraestructura de las instalaciones de investigación; y contribuir con datos de importancia a la política pública y conservación de los recursos naturales de la isla.</p>
            </div>
        </div>

        <div class="right-footer-item">
            <form class="contact-form" method="post">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" placeholder="Example@gmail.com" class="form-input" name=email required=""/>

                <label for="asunto">Asunto</label>
                <input type="text"  placeholder="Ingresa el asunto" class="form-input" name=Asunto required=""/>

                <label for="message">Mensaje</label>
                <textarea id="message" class="form-input" name="Mensaje" required=""></textarea>
                <input type="submit" name="enviar"></input>
            </form>
        </div>
<?php 

// Envío de form de email
if (isset($_POST['enviar'])){
    if(!empty($_POST['email']) && !empty($_POST['Mensaje']) && !empty($_POST['Asunto'])) {
        $asunto = $_POST['Asunto'];
        $msg = $_POST['Mensaje'];
        $email = $_POST['email'];
        $header = "From: noreply@example.com" . "\r\n";
        $header .= "Reply-To: noreply@example.com" . "\r\n";
        $header.= "X-Mailer: PHP/". phpversion();
        $mail = mail($email, $asunto, $msg, $header);
        if ($mail){
            echo "Let's go";
        }
    }
}
?>

    </section>
<section class="bottom-foter">

<div class="line-container">
        <div class="line"></div>
    </div>
    <div class="footer-links">
        <ul class="footer-list">
            <li><a href="glosario.php" alt="Link to Glosario">Glosario</a></li>
            <li><a href="literatura.php" alt="Link to Literatura">Literatura</a></li>
            <li><a href="#" alt="Link to Aspecto Técnicos">Aspecto Técnicos</a></li>
            <li><a href="#" alt="Link to Términos y Condiciones">Términos y Condiciones</a></li>
        </ul>
    </div>
  <section class="copy-right">
      <p>&copy; 2023. All rights reserved. Nosotros.</p>
  </section>
</section>
</footer>


<script>

function sendMessage() {
  const email = document.getElementById('email').value;
  const asunto = document.getElementById('asunto').value;
  const mensaje = document.getElementById('message').value;

  const data = {
    personalizations: [
      {
        to: [
          {
            email: 'joel.ruiz6@upr.edu' // correo de Joel Ruiz / director CATEC
          }
        ],
        subject: asunto
      }
    ],
    from: {
      email: email 
    },
    content: [
      {
        type: 'text/plain',
        value: mensaje
      }
    ]
  };

  fetch('https://api.sendgrid.com/v3/mail/send', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer YOUR_SENDGRID_API_KEY' // Cambia esto a tu API Key de SendGrid
    },
    body: JSON.stringify(data)
  })
    .then(response => {
      if (response.ok) {
        alert('Correo electrónico enviado exitosamente');
      } else {
        alert('Error al enviar el correo electrónico');
      }
    })
    .catch(error => {
      console.error('Error al enviar el correo electrónico:', error);
    });
}


function sendMessage() {
  
  alert("Message sent!");
}

</script>
