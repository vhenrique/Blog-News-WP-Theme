<?php
/**
 * Contact form
 * 
 * @package 	template-parts/page
 * @author 		Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see 		http://vhenrique.com My oficial portfolio
 * @version 	1.0
 * @since 		1.0
 */
	

	global $redux_options, $themePrefix;

	echo '<div class="row">';
		echo '<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">';
			
			// Verify the contact form nounce
			if( isset( $_POST ) && wp_verify_nonce( $_POST['contact-nonce'], 'contact' ) ){

				echo '<div class="alert alert-success text-center mOffsetMedium">';
					echo 'Your message has been sent!';
				echo '</div>';

				// Send email to receivers
				if( isset( $redux_options[$themePrefix . 'contactEmailReceivers'] ) && ! empty( $redux_options[$themePrefix . 'contactEmailReceivers'] ) ){
					$receptors = $redux_options[$themePrefix . 'contactEmailReceivers'];
				}
				else{
					$receptors = get_option( 'admin_email' );
				}

				// Contact subject
				if( isset( $redux_options[$themePrefix . 'contactSubject'] ) && ! empty( $redux_options[$themePrefix . 'contactSubject'] ) ){
					$subject = $redux_options[$themePrefix . 'contactSubject'];

					if( ! empty( $_POST['contactSubject'] ) ) {
						$subject .= ' - ' . $_POST['contactSubject'];
					}
				}
				else{
					$subject = 'Contact - ' . get_option( 'blogname' );
				}

				// Message to receivers
				$message = 'A message was sent by ' . $_POST['contactName'] . ' - ' . $_POST['contactEmail'] . ' through the contact form' . "\r\n" . $_POST['contactMessage'];
				$mailReceivers = wp_mail( $receptors, $subject, $message );

				/**
				 * After receivers get message, send the email to user that activated the form.
				 * Thank's message
				 */
				if( $mailReceivers ){

					/**
					 * Email thanks message
					 */
					if( isset( $redux_options[$themePrefix . 'contactThanks'] ) && ! empty( $redux_options[$themePrefix . 'contactThanks'] ) ){
						$contactMessage = $redux_options[$themePrefix . 'contactThanks'];
					}
					else {
						$contactMessage = 'Thanks! Your message was received.';
					}

					wp_mail($_POST['contactEmail'], $subject, $contactMessage);

				}
			}
			else {
				echo '<form action="' . get_permalink() . '" method="POST">';
					echo '<div class="row mOffsetMedium">';

						echo '<div class="col-md-12 col-sm-12 col-xs-12">';
							echo '<div class="form-group">';
								echo '<label for="name" class="text-italic">Name:</label>';
								echo '<input id="name" type="text" name="contactName" class="form-control" required="required">';
							echo '</div>';
						echo '</div>';

						echo '<div class="col-md-6 col-sm-6 col-xs-12">';
							echo '<div class="form-group">';
								echo '<label for="email" class="text-italic">Email:</label>';
								echo '<input id="email" type="text" name="contactEmail" class="form-control" required="required">';
							echo '</div>';
						echo '</div>';

						echo '<div class="col-md-6 col-sm-6 col-xs-12">';
							echo '<div class="form-group">';
								echo '<label for="subject" class="text-italic">Subject:</label>';
								echo '<input id="subject" type="text" name="contactSubject" class="form-control" required="required">';
							echo '</div>';
						echo '</div>';

						echo '<div class="col-md-12 col-sm-12 col-xs-12">';
							echo '<div class="form-group">';
								echo '<label for="message" class="text-italic">Message:</label>';
								echo '<textarea id="message" name="contactMessage" class="form-control" required="required" rows="5"></textarea>';
							echo '</div>';
						echo '</div>';

						wp_nonce_field( 'contact', 'contact-nonce' );

						echo '<div class="col-md-12 col-sm-12 col-xs-12">';
							echo '<button type="submit" class="btn btn-primary pull-right">Send</button>';
						echo '</div>';
					echo '</div>';
				echo '</form>';
			}

		echo '</div>';
	echo '</div>';
?>