<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title>Guida</title>
</head>
<body>
	<div class="tutorial-box">
		<h1 id="tesseramento">Tesseramento</h1>
			<p>La sezione tesseramento può essere usata in due modi:</p>
			<ul>
				<li>Per recuperare le informazioni di un tesserato;
					Da qui è possibile:
					<ul>
						<li>Modificare le informazioni;</li>
						<li>Eliminare il tesserato;</li>
						<li>Stampare le informazioni;</li>
						<li>Stampare la tessera;</li>
					</ul>
				</li>
				<li>Per creare un nuovo tesserato;</li>
			</ul>
			<h2>Recuperare le informazioni di un tesserato</h2>
			<p>Per recuperare le informazioni su un tesserato è sufficiente scrivere il nome di quest'ultimo nel campo nome.
			Apparirà una tendina da cui sarà possibile selezionare il tesserato cliccandoci sopra o selezionandolo con le frecce direzionali della tastiera e premendo tab.
			Entrambi i metodi faranno apparire le informazioni sul tesserato ed i <a href="#avvisi"> relativi avvisi</a></p>
			Cliccando su Mostra avanzate sarà possibile vedere ulteriori informazioni riguardo il tesserato.
			<img src="" alt="Tendina su ricerca tesserato">
			<h3>Eliminare un tesserato</h3>
			Dopo aver recuperato i dati, in basso apparirà il tasto rosso "Elimina". Cliccando su di esso apparirà una finestra di conferma.
			Procedendo il tesserato verrà disattivato, ovvero non apparirà piàù nella ricerca ne sarà possibile iscriverlo ad una gara, ma i dati saranno ancora presenti nel database.
			Non è possibile eliminare automaticamente un tesserato in modo permanente.
			<h3>Modificare le informazioni</h3>
			Per modifcare le informazioni è sufficiente apportare le modifiche e premere il pulsante giallo Modifica. Apparirà un avviso per confermare l'avvenuta modifica.
			<h3>Stampare le informazioni</h3>
			Dopo aver recuperato i dati, in basso apparirà il tasto Stampa.
			Cliccando verrà generata l'anteprima del browser per la stampa, corredata di campi testo impostati dal pannello di controllo.
			Premere stampa per procedere.
			Se vuoi sapare come aggiungere o modificare il testo che viene stampato <a href="#layout_di_stampa">clicca qui</a>.
			<h3>Stampare la tessera</h3>
			Dopo aver recuperato i dati, in basso apparirà il tasto Stampa tessera.
			Si verrà portati alla pagina per la stampa della tessera, e da qui sarà possibile stamparla.
			Per maggiori dettagli su questa parte <a href="#stampa_tessera">clicca qui</a>.
			<h2 id="creare_nuovo_tesserato">Creare un nuovo tesserato</h2>
			Cliccare sulla casella Nome ed inserire il nome del tesserato.
			Questa è l'unica informazione strettamente necessaria per creare un nuovo tesserato.
			In basso apparirà il tasto verde Salva, cliccando un apparirà un avviso per confermare l'avvenuto salvataggio.
			Quando si crea un nuovo tesserato per poter stampare la tessera e poter inviare i dati ai sistemi csen è buona norma inserire tutti i dati.
			<h2>Mostra avanzate</h2>
			Questa sezione contiene informazioni facoltative che possono essere <a href="#elenco_campi_iscrizione">abilitate dal pannello di controllo</a>.
			Se necessario possono essere richiesti nuovi campi personalizzati.

		<h1 id="iscrizione_a_gara">Iscrizione a gara</h1>
			<p>Da qui è possibile iscrivere un tesserato ad un evento. Nota che non è possibile iscrivere persone non tesserate, quindi prima di poter inserire qui un nome è necessario <a href="#creare_nuovo_tesserato">farle diventare tesserati</a>.</p>

			<p>A sinistra di questa sezione si trova la parte relativa all'evento. Dal menu a tendina selezionare l'evento a cui si vuole iscrivere la persona.
			Per sapere come creare un nuovo evento <a href="#nuovo_evento">clicca qui</a>.</p>
			<p>Dopo aver selezionato l'evento inserire il nome della persona nel campo nome e selezionare il nome dalla tendina che compare.
			In alternativa è possibile usare il lettore di codici a barre se si ha la tessera della persona da iscrivere. <a href="">Maggiori dettagli qui</a>
			Tutti gli altri campi sono facoltativi.</p>

			<p>Per iscrivere una squadra selezionare la tab Dati squadra in alto e completare i campi allo stesso modo.</p>

			<p>Nella parte a destra c'è la sezione relativa al numero. Ogni evento ha un set di numeri disponibili compresi tra 0 e 200. 
			Non è possibile iscrivere due concorrenti con lo stesso numero ad eccezzione dello zero.
			Si può scrivere il numero nel campo a disposizione o selezionarlo dal menu a tendina. Nella tendina saranno presenti solo i numeri ancori liberi per l'evento.
			Se il numero scritto risulta occupato verrà segnalato con un avviso.</p>

			<p>È possibile stampare l'iscrizione spuntando la casella in alto a destra. Se la casella è spuntata quando si conferma l'iscrizione apparirà l'antprima del browser per la stampa, corredata di campi testo impostati dal pannello di controllo.
			Premere stampa per procedere.
			Se vuoi sapare come aggiungere o modificare il testo che viene stampato <a href="#layout_di_stampa">clicca qui</a>.</p>

			<p>Quando tutti i dati sono inseriti cliccare sul tasto Iscrivi a ... quindi apparirà un avviso per confermare l'avvenuta iscrizione. </p>

			<p>È possibile visualizzare tutti gli iscritti all'evento cliccando su stampa lista iscritti evento nella sezione dedicata all'evento a sinistra.
			Per ulteriori dettagli sulla lista degli iscritti ad un evento <a href="#lista_iscritti_evento">clicca qui</a>.</p>
		<h1 id="pannello_di_controllo">Pannello di controllo</h1>
			<h2 id="eventi">Eventi</h2>
				<h3 id="nuovo_evento">Nuovo evento</h3>
				Da qui è possibile creare un nuovo evento. I dati obbligatori sono nome e data. Non è possibile creare due eventi con lo stesso nome.
				<h3 id="gestione_evento">Gestione evento</h3>
				Dal menu a tendina è possibile selezionare tutti gli eventi presenti, vederne i dettagli e modificarli. Per farlo è sufficiente apportare le modifiche e cliccare su modifica. Un avviso confermerà l'avvenuta modifca.
				Cliccando invece su Elimina l'evento verrà cancellato. Fare attenzione, quando un evento viene cancellato tutti i dati relativi a tele evento, come gli iscritti, verranno persi definitivamente.
			<h2 id="layout_di_stampa">Layout di stampa</h2>
			Da qui è possibile gestire il testo che verrà stampato quando si decide di stampare un nuovo tesseramento o un'iscrizione ad un evento.
			Il rettangolo color rosa corrisponde alle dimensioni di un foglio A4. È possibile inserire del testo sopra e/o sotto i dati del tesserato.
			Per ulteriroi informazioni fare riferimento alla colonna destra della pagina.
			<h2 id="elenco_campi_iscrizione">Elenco campi iscrizione</h2>
			Qui è visibile un elenco di campi facoltativi durante il tesseramento. SOno i campi che si trovano sotto la voce "Mostra avanzate".
			Solo i campi spuntati verranno visualizzati. 
			<p>Se necessario possono essere richiesti nuovi campi personalizzati.</p>
		<h1 id="stampa_tessera">Stampa tessera</h1>
		<h1 id="avvisi">Avvisi</h1>
		Gli avvisi servono per confermare l'esito di un'azione.
		Ci sono tre tipi di avvisi, contraddistinti da tre diversi colori:
		<ul>
			<li>Verde: L'azione è stata completata con successo;</li>
			<li>Rosso: L'azione non è stata completata. È possibile leggere il motivo dell'errore nell'avviso;</li>
			<li>Blu: Avviso informativo, serve a comunicare maggiori informazioni su un'azione;</li>
		</ul>
		<h1 id="lista_iscritti_evento">Lista iscritti evento</h1>
		Qui è possibile vedere un elenco degli iscritti con tutte le informazioni.
		Per stampare l'elenco cliccare su Stampa.
		Per salvare l'elenco in formato csv (leggibile da Excel) cliccare su Formato csv.
		Se una data informazione non interessa, ad esempio Motoclub o varie, e possibile eliminare la colonna cliccando sulla X accanto al nome della colonna.
		L'ordine delle colonne può essere modificato usando le frecce accanto al nome della colonna.
		L'elenco può essere modificato cliccando su Modifica, quindi su Salva.
		Per eliminare un iscritto fare click sulla X all'inizio della riga corrispondente.
		<img src="" alt="Pagina elenco iscritti ad evento">

	</div>
</body>
</html>