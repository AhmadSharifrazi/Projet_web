<?php
class PayementsController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		$errorNewYear = '';
		$errorPayement = '';
		$errorValidate = '';

		#PHPMailer
		require 'lib/PHPMailer/Exception.php';
		require 'lib/PHPMailer/PHPMailer.php';
		require 'lib/PHPMailer/SMTP.php';

		$mail = new PHPMailer(true);                       // true active les exceptions
				try {
					//Server settings
					$mail->SMTPDebug = 0;                          // Disable verbose debug output (=2 pour activer)
					$mail->isSMTP();                               // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com';         	   // Specify main SMTP server
					$mail->SMTPAuth = true;                        // Enable SMTP authentication
					$mail->Username = 'projetwebipl@gmail.com';             // SMTP username
					$mail->Password = 'projet_web';           // SMTP password
					$mail->SMTPSecure = 'tls';                     // Enable TLS encryption, 'ssl' also accepted
					$mail->Port = 587;                             // TCP port to connect to

					//Recipients
					$mail->setFrom('projetwebipl@gmail.com', 'Mailjet Mailer');
					$mail->addAddress('projetwebipl@gmail.com', 'Xavier');				// Add a recipient
					$mail->addReplyTo(/*htmlspecialchars($_POST['email'])*/ 'xavier061296@gmail.com', 'Mailer');
					//$mail->addCC('cc@example.com');
					//$mail->addBCC('bcc@example.com');

					//Attachments
					//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
					//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Mail du site des bonnes nouvelles';
					$mail->Body    = /*htmlspecialchars($_POST['message'])*/ 'Salut';
					//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->send();
					$notification='Vos informations ont été transmises avec succès.';
				} catch (Exception $e) {
					$notification='Vos informations n\'ont pas été transmises. '.'Mailer Error: '.$mail->ErrorInfo;
				}

		if(!empty($_POST['newMember'])) {
			$test = $this->_db->validate_member(htmlspecialchars($_POST['newMember']));
			if($test != null) $errorValidate = $test;
			else $errorValidate  = 'Le membre ' . htmlspecialchars($_POST['newMember']) . ' a bien été validé' ;    #pense pas qu'il faille faire comme ça
		}


	if(!empty($_POST['newYearPayement'])){
			if(htmlspecialchars($_POST['newYearPayement'] > 999)) $errorNewYear = "Votre cotisation dépasse 999 €";
			else {
			$test = $this->_db->NewYearPayement(htmlspecialchars($_POST['newYearPayement']));
				if($test != null) $errorNewYear = $test;
			}
		}


		if(!empty($_POST['newMemberInOrder']) && !empty($_POST['amount_payed'])){
			if(htmlspecialchars($_POST['amount_payed']) > 999) $errorPayement = "Votre cotisation dépasse 999 €";
			else {
				$test = $this->_db->add_payement(htmlspecialchars($_POST['newMemberInOrder']), htmlspecialchars($_POST['amount_payed']));
				if($test != null)	$errorPayement = $test;
			}
		}


		if(!empty($_POST['newResponsability']) && !empty($_POST['newUserResponsability'])){
			$this->_db->modify_responsability(htmlspecialchars($_POST['newResponsability']), htmlspecialchars($_POST['newUserResponsability']));
		}


		if(!empty($_POST['members_not_in_order'])){
			$tabMembers = $this->_db->members_not_in_order();
		#	if ($tabMembers[0] === 0) $infoPayement = "Tous les membres sont en ordre de paiement";
		//	if($tabMembers == null) $tabMembers[0] = "Tout le monde est en ordre de paiement";
		}


		require_once(CHEMIN_VUES.'Payements.php');

	}
}
?>
