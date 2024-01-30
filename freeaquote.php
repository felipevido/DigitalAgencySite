<?php
if(isset($_POST['email'])) {
 
    // INFORMAÇÕES DA EMCOSTA
    $email_to = "comercial@emcosta.com.br";
    $email_subject = "Orçamento Cliente Emcosta";
 
    function died($error) {
      // CÓDIGOS DE ERRO NO PROCESSO DE VALIDAÇÃO
      echo "Sentimos muito! Não foi possível enviar seu formulário para a Emcosta. ";
      echo "Encontramos o(s) seguinte(s) erro(s):<br /><br />";
      echo $error."<br /><br />";
      echo "Por favor, revise os campos incorretos e tente novamente.<br /><br />";
      die();
  }
 
 
    // VALIDAÇÃO PARA CONFERIR SE OS CAMPOS FORAM PREENCHIDOS
    if(
        !isset($_POST['website']) ||
        !isset($_POST['company']) ||
        !isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['email']) ||
        !isset($_POST['name']) ||
        !isset($_POST['message'])) {
        died('Desculpe. Ocorreu um problema com o envio, recarregue a página e tente novamente.');
    }
 
     
 
    $url = $_POST['website']; // OBRIGATÓRIO
    $company = $_POST['company']; // OBRIGATÓRIO
    $fname = $_POST['fname']; // OBRIGATÓRIO
    $phone = $_POST['phone']; // OBRIGATÓRIO
    $email_from = $_POST['email']; // OBRIGATÓRIO
    $reason = $_POST['name']; // OBRIGATÓRIO


    // $reason1 = $reason[0];
    // $reason2 = $reason[1];
    // $reason3 = $reason[2];
    // $reason4 = $reason[3];
    // $reason5 = $reason[4];
    // $reason6 = $reason[5];


    $comments = $_POST['message']; // OBRIGATÓRIO

 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Informe um endereço de Email válido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$fname)) {
    $error_message .= 'Informe um nome válido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Infome uma mensagem válida.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalhes do formulário abaixo.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "URL: ".clean_string($url)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "First Name: ".clean_string($fname)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Reason: ".clean_string($reason1)."\n";
    $email_message .= "               ".clean_string($reason2)."\n";
    $email_message .= "               ".clean_string($reason3)."\n";
    $email_message .= "               ".clean_string($reason4)."\n";
    $email_message .= "               ".clean_string($reason5)."\n";
    $email_message .= "               ".clean_string($reason6)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// CRIAÇÃO DO CABEÇALHO DE EMAIL
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- MENSAGEM DE ENVIO BEM SUCEDIDO -->
 
Obrigado por entrar em contato! Em breve a equipe da Emcosta te responderá, fique de olho no seu Email, até mais...
 
<?php
 
}
?>