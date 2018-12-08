<?php

namespace Application\Model;
use \PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/*
*------------------------------------
* Classe responsável pelo envio de emails
*-----------------------------------
*/
class Email
{
      private $mailer;
      private $host = "smtp-mail.outlook.com";
      private $username = "";
      private $password = "";
      private $smtpSecure = "TLS";
      private $port = "587";
      private $link = "http://localhost/";
                  
      function __construct()
      {                
            $this->mailer = new \PHPMailer\PHPMailer\PHPMailer();
            $this->mailer->setLanguage('pt-br', 'vendor/phpmailer/phpmailer/language');
            $this->mailer->SMTPDebug = 1;
            // Enable verbose debug output
            $this->mailer->isSMTP();
            // Set mailer to use SMTP
            $this->mailer->Host = $this->host;
            // Specify main and backup SMTP servers      
            $this->mailer->SMTPAuth = true;
            // Enable SMTP authentication
            $this->mailer->Username = $this->username;
            // SMTP username
            $this->mailer->Password = $this->password;
            // SMTP password
            $this->mailer->SMTPSecure = $this->smtpSecure;
            // Enable TLS encryption, `ssl` also accepted
            $this->mailer->Port = $this->port;
            // TCP port to connect to
            $this->mailer->setFrom($this->username, SYSTEM_NAME); 
            $this->mailer->isHTML(true);
            // Set email format to HTML
            $this->mailer->charSet = "UTF-8";
      }

      /*
      *------------------------------------
      * Função que define  a estrutura
      * padrão dos emails
      *-----------------------------------
      * @mensagem para concatenar
      * dentro do padrão
      */
      public function pattern($mensagem)
      {
            return "
            <div align='left'>
                  <table style='width: 100%;'>
                        <tr>
                        <td width='100%' align='center'>
                        <h3>".SYSTEM_NAME."</h3>
                        </td>
                        </tr>
                  </table> 
                  ".$mensagem."                
            </div>  
            ";
      }


      /*
      *------------------------------------
      * Função que define  a estrutura
      * padrão dos emails
      *-----------------------------------
      * @mensagem para concatenar
      * dentro do padrão
      */
      public function registrar($usuario_id, $hash, $email)
      {            
            $this->mailer->addAddress($email); 
            // Name is optional
            $this->mailer->addReplyTo('maikel-93@hotmail.com', 'SYSTEACHER');      
            //$this->mailer->addAttachment('/var/tmp/file.tar.gz');
            // Add attachments
            //$this->mailer->addAttachment('/tmp/image.jpg', 'new.jpg');
            // Optional name      
            $assunto = utf8_decode(SYSTEM_NAME);
            $this->mailer->Subject = $assunto;
            $texto = "
            <p>Confirme a criação de sua conta clicando no link abaixo.</p><br>
            <a href='{$this->link}registrar/{$usuario_id}/{$hash}'>Link</a>
            ";
            $mensagem = utf8_decode($this->pattern($texto));

            $this->mailer->Body    = $mensagem;
            $mensagemSemHTML = utf8_decode($texto);
            $this->mailer->AltBody = $mensagemSemHTML;
            if(!$this->mailer->send()) {
                  if (ENVIRONMENT == "development") {
                        var_dump($this->mailer->ErrorInfo);
                        exit();
                  }         
                  return false;
            } else {
                  return true;
            }
      }

      /*
      *------------------------------------
      * Função que define  a estrutura
      * padrão dos emails
      *-----------------------------------
      * @mensagem para concatenar
      * dentro do padrão
      */
      public function recuperarSenha($email, $hash)
      {            
            $this->mailer->addAddress($email);
            $this->mailer->addReplyTo('maikel-93@hotmail.com', 'SYSTEACHER');      
            $assunto = utf8_decode(SYSTEM_NAME);
            $this->mailer->Subject = $assunto;
            $texto = "
            <p>Acesse o link abaixo para alterar sua senha.</p><br>
            <a href='{$this->link}recuperarsenha/{$hash}'>Link</a>
            ";
            $mensagem = utf8_decode($this->pattern($texto));
            $this->mailer->Body    = $mensagem;
            $mensagemSemHTML = utf8_decode($texto);
            $this->mailer->AltBody = $mensagemSemHTML;
            if(!$this->mailer->send()) {
                  if (ENVIRONMENT == "development") {
                        var_dump($this->mailer->ErrorInfo);
                        exit();
                  }  
                  return false;
            } else {
                  return true;
            }
      }
}
?>