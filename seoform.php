<?php
if(isset($_POST['email'])) {
 
   // INFORMAÇÕES DA EMCOSTA
   $email_to = "comercial@emcosta.com.br";
   $email_subject = "Inicio Cliente Emcosta";

   function died($error) {
     // CÓDIGOS DE ERRO NO PROCESSO DE VALIDAÇÃO
     echo "Sentimos muito! Não foi possível enviar seu formulário para a Emcosta. ";
     echo "Encontramos o(s) seguinte(s) erro(s):<br /><br />";
     echo $error."<br /><br />";
     echo "Por favor, revise os campos incorretos e tente novamente.<br /><br />";
     die();
 }
 
 
    // validation expected data exists
    if(!isset($_POST['url']) ||
        !isset($_POST['email'])) {
        died('Desculpe. Ocorreu um problema com o envio, recarregue a página e tente novamente.');       
    }
 
     
 
    $url = $_POST['url']; // OBRIGATÓRIO
    $email_from = $_POST['email']; // OBRIGATÓRIO
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Informe um Email válido.<br />';
  }
 
 
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalhes do formulário abaixo.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($url)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
// CRIAÇÃO DO CABEÇALHO DE EMAIL
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Obrigado por entrar em contato! Em breve a equipe da Emcosta te responderá, fique de olho no seu Email, até mais...
 
<?php
 
}
?>