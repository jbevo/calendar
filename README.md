# calendar

questo progetto è pensato per gestire una qunantita di appuntamenti
e utenti in modo molto semplice

il documento è diviso in

## index
in questa pagina html troviamo solo dei bottoni che ci reindirizzano 
nelle pagine responsabili per il funzionamento della pagina

| bottone                 |      pagina       |
|:------------------------|:-----------------:|
| registra nuovo utente   |  registerNewUser  |
| visualizza utenti       |     viewUsers     |
| richiedi appuntamento   | requestApointment |
| visualizza appuntamenti |   calendarLogic   |


## registerNewUser
in questa pagina possiamo andare a salvare un nuovo utente,
tutti gli utenti e le loro informazioni vengolo salvate in __userData__
dopo la registrazione si viene reindirizzati alla pagina __dataSaveLogic__

## requestApointment
questa pagina server per arrivare a __dataSaveLogic__ senza andare a creare una pagina un nuovo utente
ma usandone uno già esistente in __userData__

## dataSaveLogic
è una pagina di transizione
se raggiunta attraverso __registerNewUser__ salva i dati dentro il csv,
se raggiunta da __requestApointment__ salverà un appuntamento con un nome che esiste già,
dopo di che si verrà reinderizzati sulla pagina calendar logic, tutti gli appuntamenti vengono slavati in __apointments__

## calendarLogic
genera il calendario del mese attuale,
se raggiunto da __index__ colorerà ogni giorno con degli appuntamenti in verde,
se raggiunto da __dataSaveLogic__ tutte le date con degli appuntamneti verranno colorate in verde a parte
il giorno del ultimo appuntamento inserito che sarà verde scuro,
in questa pagina evngolo anche salvati gli appuntamenti nel file pointments

## dayLogic
nel calendario avremmo la possibilità di andare a vedere gli appuntamenti di ogni giorno cliccandoci sopra,
facendo così vedremmo tutti gli appuntamenti di un giorno


## viewUsers
genera una tabella usando gli user prenseti in __userData__