<?php
if(isset($_POST['email'])) {
 
    // INFORMAÇÕES DA EMCOSTA
    $email_to = "comercial@emcosta.com.br";
    $email_subject = "FAQ Cliente Emcosta";
 
    function died($error) {
      // CÓDIGOS DE ERRO NO PROCESSO DE VALIDAÇÃO
      echo "Sentimos muito! Não foi possível enviar seu formulário para a Emcosta. ";
      echo "Encontramos o(s) seguinte(s) erro(s):<br /><br />";
      echo $error."<br /><br />";
      echo "Por favor, revise os campos incorretos e tente novamente.<br /><br />";
      die();
  }
 
 
    // VALIDAÇÃO PARA CONFERIR SE OS CAMPOS FORAM PREENCHIDOS
    if(!isset($_POST['name']) ||
        !isset($_POST['url']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('Desculpe. Ocorreu um problema com o envio, recarregue a página e tente novamente.');       
    }
 
     
 
    $url = $_POST['url']; // OBRIGATÓRIO
    $name = $_POST['name']; // OBRIGATÓRIO
    $email_from = $_POST['email']; // OBRIGATÓRIO
    $comments = $_POST['message']; // OBRIGATÓRIO
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Informe um endereço de Email válido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Informe um nome válido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Informe uma mensagem válida.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalhes do formulário abaixo.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "URL: ".clean_string($url)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
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