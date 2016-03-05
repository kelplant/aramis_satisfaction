# aramis_satisfaction

Formulaire de satisfacttion

1) General bundle : /home
  - Affiche les tickets à répondre
  - Affiche les tickets répondus 
  
2) Form Bundle : 
  - Réponse au formulaire de satisfaction /form/new/{numticket}
  - Visualisation d'un quesitonnaire répondu /form/view/{numticket}
  - Edittion du résultat d'un questionaire répondu /form/edit/{numticket}

3) Crawler Bundle (Zendesk) /crawler
  - Crawl les tickets, charge tous ceux résolus depuis "hier" 
  - Crawl les tickets si reopen - reinitilise envoi mail et incrémente
  
4) Mailer Bundle
  - Envoi du premier mail à tous les tickets sans date d'envoi de premier mail /mail/batchQuotidien
  - Envoi du mail de relance à tous les tickets avec date d'envoi du premier mail > 7jours /mail/batchHebdo

TODO
- SAML ADFS ou NTLM
