function pulisciform(){
	document.getElementById('errore_nominativo').innerHTML = "";
		 	document.tutto.nominativo.style.borderColor=null;
			document.tutto.nominativo.style.backgroundColor=null;
			document.tutto.lente.style.borderColor=null;
}
function pass(){
	var num=document.squadra.elenco.value;
	document.squadra.numero.value=num;
}
function pass2(){
	var num=document.tutto.elenco.value;
	document.tutto.numero.value=num;
	document.tutto.bignumber.value=num;
	document.getElementById('altro11').value=' n° '+num;
	document.getElementById('altro22').value=' n° '+num;
}
function formatDate (input) {
  var datePart = input.match(/\d+/g),
  year = datePart[0].substring(0), // get only two digits
  month = datePart[1], day = datePart[2];

  return day+'/'+month+'/'+year;
}
function eliminaall(){
	var nome=document.tutto.nominativo.value;
	if(nome){
	if (confirm("Stai per cancellare definitivamente l'iscritto "+nome))
{
location.href = "eliminaall.php?nome="+nome; 
}}
else{
	document.tutto.nominativo.style.borderColor="#ff0000";
}
}
function add(){
	e = document.getElementById("add1");
	if(e.style.display=='block'){
	e.style.display='none';
	e.style.visibility = 'hidden';	
	}else{
	e.style.display='block';
	e.style.visibility = 'visible';	}
}
//oggeto ajax generale
var myRequest = null;
function CreateXmlHttpReq(handler) {
  var xmlhttp = null;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
}
function script3(x){
	var e = document.getElementById(x);
	 e.style.visibility = 'hidden';
        e.style.display = 'none';
}
function myHandler8() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		arr = myRequest.responseText.split("|");
		if(arr[0]==1){
			document.squadra.tesserael.value=arr[1];
			document.squadra.datatesserael.value=formatDate(arr[2]);
			document.squadra.tesseracsen.value=arr[3];
			document.squadra.datatesseracsen.value=formatDate(arr[4]);
		}
		if(arr[0]==2){
			document.squadra.tesserafmi.value=arr[1];
			document.squadra.datatesserafmi.value=formatDate(arr[2]);
			document.squadra.importotesserafmi.value=arr[3];
			document.squadra.tesserasport.value=arr[4];
			document.squadra.datasport.value=formatDate(arr[5]);
			document.squadra.importosport.value=arr[6];
			document.squadra.licenzafmi.value=arr[7];
			document.squadra.datalicenzafmi.value=formatDate(arr[8]);
			document.squadra.importolicenza.value=arr[9];
		}
		if(arr[0]==3){
			document.squadra.tessera.value=arr[1];
			document.squadra.datatessera.value=formatDate(arr[2]);
			document.squadra.licenza.value=arr[3];
			document.squadra.datalicenza.value=formatDate(arr[4]);
			document.squadra.procuratore.value=arr[5];
			document.squadra.altroesterni.value=arr[6];
		}
	}
}
//apri i campi del database sull'iscrizione agli eventi
function script2(x) {
    var e = document.getElementById(x);
	if(x==1){
	script3(2);
	script3(3);
	}
	if(x==2){
	script3(1);
	script3(3);
	}
	if(x==3){
	script3(1);
	script3(2);
	}
    if (e.style.visibility == 'hidden') {
		e.style.display = 'block';
        e.style.visibility = 'visible';
    } else {
        e.style.visibility = 'hidden';
        e.style.display = 'none';
    }
	var ev=document.evento.selectevento.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		alert("Seleziona evento");
	}else{
		var a=document.squadra.nominativo.value;
		if(a==""){
			document.squadra.nominativo.style.borderColor="#ff0000";
			alert("Seleziona iscritto");
	}
	else{
		for(i=0;i<3;i++){
			var b=document.squadra.database[i].checked;
			if(b==true){
				b=document.squadra.database[i].value;
				i=3;
			}
		}
		myRequest = CreateXmlHttpReq(myHandler8);
		myRequest.open("GET","h.php?a="+a+"&b="+b);
		//myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	myRequest.send(null);
	myRequest.setRequestHeader("connection", "close");
}}}
//modifica un iscritto ad un evento
function modificaiscritto(){
	var ev=document.evento.selectevento.value;
	var is=document.squadra.nominativo.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		alert("Seleziona evento");
	}
	else{
		if(is==""){
			document.squadra.nominativo.style.borderColor="#ff0000";
		}else{
			document.squadra.action = "modificaiscritto.php";
    		document.squadra.submit();
		}
	}
}
//elimina un iscritto ad un evento
function eliminaiscritto(){
	var ev=document.evento.selectevento.value;
	var is=document.squadra.nominativo.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		alert("Seleziona evento");
	}
	else{
		if(is==""){
			document.squadra.nominativo.style.borderColor="#ff0000";
		}else{
			document.squadra.action = "eliminaiscritto.php";
    		document.squadra.submit();
		}
	}
}
function myHandler7() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		arr = myRequest.responseText.split("|");
		if(arr[0]>0){
			document.squadra.nominativo.style.borderColor="#ff0000";
			document.squadra.categoria.value=arr[1];
			document.squadra.moto.value=arr[2];
			document.squadra.numero.value=arr[3];
			document.squadra.motorclub.value=arr[4];
			document.squadra.nomesquadra.value=arr[5];
			document.squadra.nominativo1.value=arr[6];
			document.squadra.nominativo2.value=arr[7];
		}
	}
}
function control4(){
	var ev=document.evento.selectevento.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		alert("Seleziona evento");
	}else{
		var a=document.squadra.nominativo.value;
		var b=document.evento.selectevento.value;
		var data="a=" + a;
		myRequest = CreateXmlHttpReq(myHandler7);
		myRequest.open("GET","g.php?a="+a+"&b="+b);
		//myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	myRequest.send(null);
	myRequest.setRequestHeader("connection", "close");
	}
}
function myHandler6() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		if(myRequest.responseText>0){
			document.squadra.numero.style.backgroundColor="#ff0000";
		}
	}
}
function myHandlertabella() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		if(myRequest.responseText>0){
			document.tabella.numero.style.backgroundColor="#ff0000";
		}
	}
}
function myHandler6bis() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		if(myRequest.responseText>0){
			document.tutto.numero.style.backgroundColor="#ff0000";
		}
	}
}
//verifica che il numero scelto sia disponibile
function control2(){
	var ev=document.evento.selectevento.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		document.evento.selectevento.style.backgroundColor="#ff0000";
		
		alert("Seleziona evento");
	}else{
		var a=document.squadra.numero.value;
		var b=document.evento.selectevento.value;
		var data="a=" + a;
		myRequest = CreateXmlHttpReq(myHandler6);
		myRequest.open("GET","f.php?a="+a+"&b="+b);
		//myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	myRequest.send(null);
	myRequest.setRequestHeader("connection", "close");
	}
}
function control2bis(){
		var ev=document.evento.selectevento.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		document.evento.selectevento.style.backgroundColor="#ff0000";
		
		alert("Seleziona evento");
	}else{
		var a=document.tutto.e_numero.value;
		document.tutto.bignumber.value=a;
		document.getElementById('altro11').value=' n° '+a;
		document.getElementById('altro22').value=' n° '+a;
		var b=document.evento.selectevento.value;
		var data="a=" + a;
		myRequest = CreateXmlHttpReq(myHandler6bis);
		myRequest.open("GET","f.php?a="+a+"&b="+b);
		//myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	myRequest.send(null);
	myRequest.setRequestHeader("connection", "close");
	}
}
//veifica se è selezionato un evento in cui inserire la squadra
function control(){
	var ev=document.evento.selectevento.value;
	var is=document.squadra.nominativo.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		alert("Seleziona evento");
	}else{
		if(is==""){
			document.squadra.nominativo.style.borderColor="#ff0000";
			alert("Seleziona iscritto");
	}else{
		
		document.squadra.action = "salvasquadra.php";
    document.squadra.submit();
	}}
}
//ricerca iscritto a gara
function myHandler2() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		arr = myRequest.responseText.split("|");
        document.squadra.categoria.value=arr[0]; 
	}
}
function control3(){
	document.squadra.nominativo.style.borderColor=null;
	var ev=document.evento.selectevento.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		alert("Seleziona evento");
	}
}
//cerca iscritti
function cerca(){
	var a=document.squadra.nominativo.value;
	var data="a=" + a;
	alert(data);
	myRequest = CreateXmlHttpReq(myHandler2);
    myRequest.open("POST","e.php");
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(data);
	myRequest.setRequestHeader("connection", "close");
}
function runScript(e) {
    if (e.keyCode == 13) {
        var ev=document.evento.selectevento.value;
	if(ev=="Seleziona"){
		alert("Seleziona evento");
	}
	else{
	var num=document.componenti.componente.value;
	//if(num>1){
	while(num>0){
		window.open("aaa.php?evento="+ev);
		num--;	
	}
	//}
	//else{
	//document.componenti.action = "gara.php?evento="+ev;
    //document.componenti.submit();
	//}
	}
        return false;
    }
}
//elimina evento
function resset(){
if(confirm("Sicuro di voler eliminare l'evento? tutti gli iscritti andranno persi")) {
document.evento.action = "elimina.php";
document.evento.submit();
}
}
//data da cui fare riassunto iscritti
function sceglidata(){
	var a=document.datatessera.data.value;
	document.datatessera.action = "riassuntoiscritti.php";
   document.datatessera.submit();
}
//visualizza risposta cerca iscritto
function myHandler() {
    if (myRequest.readyState == 4 && myRequest.status == 200 ) {
		arr = myRequest.responseText.split("|");
        document.tutto.luogonascita.value=arr[0]; 
		arr[1]=formatDate(arr[1]);
		document.tutto.datanascita.value=arr[1]; 
		document.tutto.via.value=arr[2]; 
		document.tutto.cap.value=arr[3]; 
		document.tutto.citta.value=arr[4]; 
		document.tutto.email.value=arr[5]; 
		document.tutto.telefono.value=arr[6]; 
		if(arr[7]=='1'){ 
		document.tutto.documenti.checked=true;}
		if(arr[8]=='1'){ 
		document.tutto.visita.checked=true;}
		document.tutto.sangue.value=arr[9];
		document.tutto.id.value=arr[10]; 
		document.totale.d.value=arr[11];  
		document.tutto.e_moto.value=arr[12]; 
		document.tutto.e_motorclub.value=arr[13]; 
		document.tutto.e_categoria.value=arr[14];
		document.tutto.e_numero.value=arr[15]; 	
		document.tutto.e_varie.value=arr[16]; 
		var data="a=" + arr[10];
		myRequest = CreateXmlHttpReq(myHandler2);
    myRequest.open("POST","b.php");
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(data);
	myRequest.setRequestHeader("connection", "close");
    }
}
//cerca iscritti
function find(){
	document.tutto.datanascita.value=null;
	document.tutto.luogonascita.value=null;
	document.tutto.cap.value=null;
	document.tutto.telefono.value=null;
	document.tutto.citta.value=null;
	document.tutto.email.value=null;
	document.tutto.via.value=null;
	document.tutto.sangue.value=null;
	document.tutto.documenti.checked=false;
	document.tutto.visita.checked=false;
	var b=document.tutto.evento.value;
	var a=document.tutto.nominativo.value;
	myRequest = CreateXmlHttpReq(myHandler);
   myRequest.open("GET","a.php?a="+a+"&b="+b);
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(null);
	myRequest.setRequestHeader("connection", "close");
}
//visualizza risposta lendinara
function myHandler2() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		arr = myRequest.responseText.split("|");
		if(arr[1])
		arr[1]=formatDate(arr[1]);
		if(arr[3])
		arr[3]=formatDate(arr[3]);
        document.tutto.tesserael.value=arr[0]; 
		document.tutto.datatesserael.value=arr[1]; 
		document.tutto.tesseracsen.value=arr[2]; 
		document.tutto.datatesseracsen.value=arr[3]; 
		var data="a=" + arr[4];
	myRequest = CreateXmlHttpReq(myHandler3);
    myRequest.open("POST","c.php");
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(data);
	myRequest.setRequestHeader("connection", "close");	 
    }
}
//cerca lendinara
function findlend(){
	document.tutto.tesserael.value=null; 
	document.tutto.datatesserael.value=null; 
	document.tutto.tesseracsen.value=null; 
	//document.tutto.datatesseracsen.value=null; 
	var a=document.tutto.id.value;
	var data="a=" + a;
	myRequest = CreateXmlHttpReq(myHandler2);
    myRequest.open("POST","b.php");
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(data);
	myRequest.setRequestHeader("connection", "close");
	
}
//visualizza risposta motorclub
function myHandler3() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		arr = myRequest.responseText.split("|");
		if(arr[1])
		arr[1]=formatDate(arr[1]);
		if(arr[3])
		arr[3]=formatDate(arr[3]);
		if(arr[5])
		arr[5]=formatDate(arr[5]);
        document.tutto.tesserafmi.value=arr[0]; 
		document.tutto.datatesserafmi.value=arr[1]; 
		//document.tutto.importotessera.value=arr[2];
		document.tutto.tesserasport.value=arr[4]; 
		document.tutto.datasport.value=arr[5]; 
		//document.tutto.importosport.value=arr[8];
		document.tutto.licenzafmi.value=arr[2]; 
		document.tutto.datalicenzafmi.value=arr[3]; 
		//document.tutto.importolicenza.value=arr[5];  
    }
}
//cerca motorclub
function findmotorclub(){
	var a=document.tutto.id.value;
	var data="a=" + a;
	myRequest = CreateXmlHttpReq(myHandler3);
    myRequest.open("POST","c.php");
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(data);
	myRequest.setRequestHeader("connection", "close");
	
}
//visualizza risposta esterni
function myHandler4() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
		arr = myRequest.responseText.split("|");
        document.tutto.tessera.value=arr[0]; 
		if(arr[1])
		arr[1]=formatDate(arr[1]);
		if(arr[3])
		arr[3]=formatDate(arr[3]);
		document.tutto.datatessera.value=arr[1]; 
		document.tutto.licenza.value=arr[2]; 
		document.tutto.datalicenza.value=arr[3]; 	
		document.tutto.procuratore.value=arr[4]; 
		document.tutto.altroesterni.value=arr[5];  
    }
}
//cerca esterni
function findesterni(){
	var a=document.tutto.id.value;
	var data="a=" + a;
	myRequest = CreateXmlHttpReq(myHandler4);
    myRequest.open("POST","d.php");
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(data);
	myRequest.setRequestHeader("connection", "close");
	
}
//numero di partecipanti per squadra
function checknumero(){
	alert();
	/*var ev=document.evento.selectevento.value;
	alert(ev);
	if(ev=="Seleziona"){
		alert("Seleziona evento");
	}
	else{
	var num=document.componenti.numero.value;
	//if(num>1){
	while(num>0){
		window.open("aaa.php?evento="+ev);
		num--;	
	}
	//}
	//else{
	//document.componenti.action = "gara.php?evento="+ev;
    //document.componenti.submit();
	//}
	}*/
}
function goto(){
location.href = "modulo.php#corpo"; 	
}
function goto2(){
location.href = "riassuntoeventi.php"; 	
}
function goto3(){
location.href = "riassuntoiscritti.php?on=1"; 	
}
function evento1(){
	var a=document.evento.selectevento.value;
	document.evento.action = "gara.php";
   document.evento.submit();
}
function evento2(){
	var a=document.evento.selectevento.value;
	document.evento.action = "riassuntoeventi.php";
   document.evento.submit();
}
function evento2bis(){
	var a=document.evento.selectevento.value;
	document.evento.action = "modulo.php#corpo";
   document.evento.submit();
}
//salva intestazione
function int1(){
	document.intestazione.action = "intestazione.php";
   document.intestazione.submit();	
}
//salva intestazione
function int2(){
		var tasto = window.event.keyCode;
	if (tasto == 9){
				alert();
			}else{
	document.intestazione2.action = "intestazione2.php";
   document.intestazione2.submit();	}
}
function int5(){
		var tasto = window.event.keyCode;
	if (tasto == 9){
				document.totale.a.focus();
			}
}
function int4(){
	document.totale.action = "intestazione2.php";
   document.totale.submit();
}
//cancella intestazione
function canc1(){
	document.intestazione.parte1.value="";
}
//cancella intestazione
function canc3(){
	document.intestazione2.parte3.value="";
}
function canc4(x){
	document.totale.x.value="";
}
//seleziona database (modulo.php)
function a(x){
	if (x==1)
	var e = document.getElementById("lendinara");
	else
	if(x==2)
	var e = document.getElementById("motorclub");
	else
	var e = document.getElementById("esterni");
	e.style.display='block';
	e.style.visibility = 'visible';	
	if(x==1){
	var f = document.getElementById("motorclub");
	var g = document.getElementById("esterni");
	}else{
		if(x==2){
			var f = document.getElementById("lendinara");
			var g = document.getElementById("esterni");
		}
		else{
			var f = document.getElementById("lendinara");
			var g = document.getElementById("motorclub");
		}
	}
	if(x==0){
		var e= document.getElementById("lendinara");
			var g = document.getElementById("motorclub");
			var f = document.getElementById("esterni");
		e.style.display='none';
	e.style.visibility = 'hidden';	
	}
	f.style.display='none';
	f.style.visibility = 'hidden';	
	g.style.display='none';
	g.style.visibility = 'hidden';	
}
function myHandler9() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
        if(myRequest.responseText==0){
		 document.tutto.action = "salvalendinara.php";
   		 document.tutto.submit();
		}else{
			document.getElementById('errore_nominativo').innerHTML = "Iscritto già presente";
		 	document.tutto.nominativo.style.borderColor="#ff0000";
			document.tutto.nominativo.style.backgroundColor="#ff0000";
		}
    }
}
function salvalendinara(){
	var nome=document.tutto.nominativo.value;
	if(nome){
		var data="email=" + nome;
	myRequest = CreateXmlHttpReq(myHandler9);
    myRequest.open("POST","ajaxlendinara.php");
	myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    myRequest.send(data);
	myRequest.setRequestHeader("connection", "close");
			}
else{
	document.tutto.nominativo.style.borderColor="#ff0000";
}
}
function modificalendinara(){
	var nome=document.tutto.nominativo.value;
	var id=document.tutto.id.value;
	if(nome){
		if(id){
		document.tutto.action = "modificalendinara.php";
   		document.tutto.submit();
		}else{
			document.tutto.lente.style.borderColor="#ff0000";
		}
	}else{
	document.tutto.nominativo.style.borderColor="#ff0000";
}
	
}
function salvaesterni(){
	document.tutto.action = "salvaesterni.php";
   document.tutto.submit();	
}
function modificaesterni(){
	document.tutto.action = "modificaesterni.php";
   document.tutto.submit();	
}
function salvamotorclub(){
	document.tutto.action = "salvamotorclub.php";
   document.tutto.submit();	
}
function modificamotorclub(){
	var nome=document.tutto.nominativo.value;
	var id=document.tutto.id.value;
	if(nome){
		if(id){
	document.tutto.action = "modificamotorclub.php";
   document.tutto.submit();		
		}else{
			document.tutto.lente.style.borderColor="#ff0000";
		}
	}else{
	document.tutto.nominativo.style.borderColor="#ff0000";
	}
}
function canca(){
	document.totale.a.value="";
}
function cancb(){
	document.totale.b.value="";
}
function cancc(){
	document.totale.c.value="";
}
function func(x){
	var tot=document.totale.d.value;
	tot=parseFloat(tot);
	switch(x){
		case "a":
		var a=document.totale.a.value;
		a=parseFloat(a);
		tot=tot+a;
		break;
		case "b":
		var b=document.totale.b.value;
		b=parseFloat(b);
		tot=tot+b;
		break;
		case "c":
		var c=document.totale.c.value;
		c=parseFloat(c);
		tot=tot-c;
		break;
		
	}
	document.totale.d.value=tot;
	document.tutto.contributo.value=tot;
}
//verifica datanascita
function checkdata(){
	gg=document.tutto.datanascita.value.substring(0,2)
	mm=document.tutto.datanascita.value.substring(3,5)
	aa=document.tutto.datanascita.value.substring(6,10)
	if(gg=="")
	gg=0;
	if(mm=="")
	mm=0;
	if(aa=="")
	aa=0;
	dataconv=mm+"/"+gg+"/"+aa;
	
	datanasc=new Date(dataconv)
	oggi=new Date()
	mesims=oggi.getTime() - datanasc.getTime()
	anni=Math.floor((mesims / (1000 * 60 * 60 * 24 * 30.416)/12))
	if(anni<1 || anni>90) {
	alert("Non puoi avere "+anni+" anni!")
	}
	else {
	if(anni<18){
		if (confirm("L'utente ha "+anni+ " anni"))
{		
		nominativo=document.tutto.nominativo.value;
		luogonascita=document.tutto.luogonascita.value;
		datanascita=document.tutto.datanascita.value;
		citta=document.tutto.citta.value;
		via=document.tutto.via.value;
		//document.tutto.action = "minore.php";
		window.open("minore.php?nominativo="+nominativo+"&datanascita="+datanascita+"&luogonascita="+luogonascita+"&citta="+citta+"&via="+via);
		//w.nominativo=document.tutto.nominativo.value;
		 
   		//document.tutto.submit();	
};
		
		//window.open("minore.php","Minorenne"); 
	}
	}
}
function controltabella(){
	var ev=document.evento.selectevento.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		document.evento.selectevento.style.backgroundColor="#ff0000";
		
		alert("Seleziona evento");
	}else{
		var a=document.tabella.numero.value;
		var b=document.evento.selectevento.value;
		myRequest = CreateXmlHttpReq(myHandlertabella);
		myRequest.open("GET","f.php?a="+a+"&b="+b);
		//myRequest.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	myRequest.send(null);
	myRequest.setRequestHeader("connection", "close");
	}
}
function salvatabella(){
	var ev=document.evento.selectevento.value;
	var is=document.tabella.nominativo.value;
	if(ev=="Seleziona"){
		document.evento.selectevento.style.borderColor="#ff0000";
		alert("Seleziona evento");
	}else{
		if(is==""){
			document.tabella.nominativo.style.borderColor="#ff0000";
			alert("Seleziona iscritto");
	}else{
		
		document.tabella.action = "salvasquadra.php";
    	document.tabella.submit();
	}}
}