<?php
if(isset($_POST['phone'])) {
 
    // INFORMAÇÕES DA EMCOSTA
    $email_to = "comercial@emcosta.com.br";
    $email_subject = "Rodapé Cliente Emcosta";
 
    function died($error) {
      // CÓDIGOS DE ERRO NO PROCESSO DE VALIDAÇÃO
      echo "Sentimos muito! Não foi possível enviar seu formulário para a Emcosta. ";
      echo "Encontramos o(s) seguinte(s) erro(s):<br /><br />";
      echo $error."<br /><br />";
      echo "Por favor, revise os campos incorretos e tente novamente.<br /><br />";
      die();
  }
 
 
    // VALIDAÇÃO PARA CONFERIR SE OS CAMPOS FORMA PREENCHIDOS
    if(!isset($_POST['phone'])) {
        died('Desculpe. Ocorreu um problema com o envio, recarregue a página e tente novamente.');       
    }
 
     
 
    $email_from = $_POST['phone']; // OBRIGATÓRIO
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Informe um número de telefone valido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalhes do formulário abaixo:\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
// CRIAÇÃO DE CABEÇALHO DE EMAIL
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- MENSAGEM DE ENVIO BEM SUCEDIDO -->
 
Obrigado! Agora você é um membro exclusivo dos contatos da Emcosta Digital.
 
<?php
 
}
?>