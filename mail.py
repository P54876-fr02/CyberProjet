import smtplib

# Fonction pour envoyer un e-mail à l'administrateur
def envoyer_email(destinataire, sujet, message):
    # Paramètres SMTP du serveur d'envoi d'e-mails
    smtp_server = "CyberProjet"
    smtp_port = 587
    smtp_username = "your_username"
    smtp_password = "your_password"

    # Construction de l'e-mail
    email_message = f"Subject: {sujet}\n\n{message}"

    try:
        # Connexion au serveur SMTP
        server = smtplib.SMTP(smtp_server, smtp_port)
        server.starttls()
        server.login(smtp_username, smtp_password)

        # Envoi de l'e-mail
        server.sendmail(smtp_username, destinataire, email_message)
        print("E-mail envoyé avec succès !")

        # Fermeture de la connexion au serveur SMTP
        server.quit()
    except Exception as e:
        print("Erreur lors de l'envoi de l'e-mail :", str(e))


# Exemple de détection d'intrusion
intrusion_detectee = True

if intrusion_detectee:
    destinataire_administrateur = "admin@example.com"
    sujet_intrusion = "Intrusion détectée !"
    message_intrusion = "Une intrusion a été détectée sur votre application web. Veuillez prendre les mesures nécessaires."
    envoyer_email(destinataire_administrateur, sujet_intrusion, message_intrusion)


# Exemple de détection d'attaque DDoS
attaque_ddos_detectee = True

if attaque_ddos_detectee:
    destinataire_administrateur = "adminsys@yopmail.com"
    sujet_attaque_ddos = "Attaque DDoS détectée !"
    message_attaque_ddos = "Votre application web subit actuellement une attaque DDoS. Veuillez agir rapidement pour atténuer les effets."
    envoyer_email(destinataire_administrateur, sujet_attaque_ddos, message_attaque_ddos)