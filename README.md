# aramis_satisfaction

Formulaire de satisfacttion

1) Generalbundle : /home
  - Affiche les tickets à répondre
  - Affiche les tickets répondus 
  
2) FormBundle : 
  - Réponse au formulaire de satisfaction /form/new/{numticket}
  - Visualisation d'un quesitonnaire répondu /form/view/{numticket}
  - Edittion du résultat d'un questionaire répondu /form/edit/{numticket}

3) CrawlerBundle (Zendesk) /crawler
  - Crawl les tickets, charge tous ceux résolus depuis "hier" 
  - Crawl les tickets si reopen - reinitilise envoi mail et incrémente
  
4) MailerBundle
  - Envoi du premier mail à tous les tickets sans date d'envoi de premier mail /mail/batchQuotidien
  - Envoi du mail de relance à tous les tickets avec date d'envoi du premier mail > 7jours /mail/batchHebdo

5) AppBundle : Authentification SAML
  - Echange d'accès avec ADFS
  - Création du User
  - Logout
