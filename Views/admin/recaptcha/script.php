<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
<script src='https://www.google.com/recaptcha/api.js?render=<?= $data["CLAVE_SITIO_WEB"] ?>'> </script>
 <script>
     grecaptcha.ready(function() {
         grecaptcha.execute('<?= $data["CLAVE_SITIO_WEB"] ?>', {action: 'formulario'})
         .then(function(token) {
             var recaptchaResponse = document.getElementById('recaptchaResponse');
             recaptchaResponse.value = token;
         });
    });
 </script>
