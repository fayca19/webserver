function loadList(page){
$("#content").load(page);
}
function diffdate(d1,d2){
var WNbJours = d2.getTime() - d1.getTime();
return Math.ceil(WNbJours/(1000*60*60*24));
}
// Changement de date au format anglais ***********************
function dfrtoen(date1)
{
var split_date=date1.split('/');
var new_d=new Date(split_date[2], split_date[1]*1 - 1, split_date[0]*1);
 var new_day = new_d.getDate();
       new_day = ((new_day < 10) ? '0' : '') + new_day; // ajoute un zéro devant pour la forme
   var new_month = new_d.getMonth() + 1;
       new_month = ((new_month < 10) ? '0' : '') + new_month; // ajoute un zéro devant pour la forme
   var new_year = new_d.getYear();
       new_year = ((new_year < 200) ? 1900 : 0) + new_year; // necessaire car IE et FF retourne pas la meme chose
   var new_date_text = new_year + '-' + new_month + '-' + new_day;
   return new_date_text;
}
//**************************************************************
// Ajout un nombre de jour à une date *****************
function addDays(dd,xx) {
   // Date plus plus quelques jours
   var split_date = dd.split('/');
   var new_date = new Date(split_date[2], split_date[1]*1 - 1, split_date[0]*1 + parseInt(xx)-1);
   var dd= new Date(split_date[2], split_date[1]*1 - 1, split_date[0]*1);
   var new_day = new_date.getDate();
       new_day = ((new_day < 10) ? '0' : '') + new_day; // ajoute un zéro devant pour la forme
   var new_month = new_date.getMonth() + 1;
       new_month = ((new_month < 10) ? '0' : '') + new_month; // ajoute un zéro devant pour la forme
   var new_year = new_date.getYear();
       new_year = ((new_year < 200) ? 1900 : 0) + new_year; // necessaire car IE et FF retourne pas la meme chose
   var new_date_text = new_day + '/' + new_month + '/' + new_year; 
   return new_date_text;
}
//**************************
// Verification du format de la date
function verifdate(dd)
{
var regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
   var test = regex.test(dd.value);
if(test){
var dd1=new Date(dfrtoen(dd.value));
var Now = new Date();
Now.setHours(0);
Now.setMinutes(0);
Now.setSeconds(0)
dd1.setHours(1);
dd1.setMinutes(0);
dd1.setSeconds(0)
if (dd1.getTime() < Now.getTime()){
alert("la date ne doit pas etre inferieur a aujourd'huit!");
dd.value="";
}}else{alert("Format date incorrect! jj/mm/aaaa");dd.value="";}
}
//*******************
// Verifi le champs si il est vide ***********
function verif(chp)
{

if ( chp.value == "" )
{
alert ( "Champs obligatoire !" );
document.getElementById(chp.id).focus();
return;
}

}
//*******************************************
// Si le champs comporte un caractere speciale ************
function is_special(char)
 {
  var exp = new RegExp("[,*$?!=+|&°%àäâéèêëïîöôùüû']");
  return exp.test(char);
 }
function verif(ch) {	
if (is_special(ch.value)){ 
ch.value="";
alert("Votre pseudo ne dois pas contenir de caracteres speciaux");	}		
}
//******************************************************** 
// Format date ******************************************
function verifdate1(dd)
{
var regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
var test = regex.test(dd.value);
if(!test){alert("Format date incorrect! jj/mm/aaaa");dd.value="";}
}
//***********************

//***********************************************
// Scripte d'initialisation de la date **********
function initdate(){
Date.firstDayOfWeek = 0;
Date.format = 'dd/mm/yyyy';
$(function()
{$('.date-pick').datePicker({startDate:'01/01/1930'});});
}
//***********************************************
// Appel aux classe dans l'acceuil
function loadLista(page){$("#slider").load(page);}

//*************************************************
// Mise à jour du compte prestataire
function update(){
var nom=document.getElementById("nuser").value;
var prenom=document.getElementById("puser").value;
var adresse=document.getElementById("euser").value;
var login=document.getElementById("luser").value;
var pass=document.getElementById("pwuser").value;
if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
if(pass && nom && prenom && login){
xhr.open("GET", "contact/mjcompte.php?row="+nom+"&row1="+prenom+"&row2="+login+"&row3="+pass+"&row4="+adresse, false);
xhr.send(null);
alert("Mise-a-jour du compte avec succes!");
//window.location.replace('../accueil.html');
loadList('contact/contact.php');
}else{alert("Merci de Remplir tout les champs obligatoires !");}	
}
//*************************************************
// Annuler une demande 
function ddemande(code){
if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
var ok=confirm("Confirmation sur annulation");
if (ok){
xhr.open("GET", "demande/ddemande.php?r0="+code, false);
xhr.send(null);
alert("Demande Supprimer!");
$("#content").load('demande/instanceec.php');
}
}
//*************************************************
//Valider une demande

function vdemande(code){
if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
var ok=confirm("Confirmation la demande");
if (ok){
xhr.open("GET", "demande/vdemande.php?r0="+code, false);
xhr.send(null);
alert("Demande Confirmee!");
$("#content").load('demande/instancec.php');
}
}
//************************************************
// Imprimer une demande
function pdem(code){
if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
window.open("sortie/Demande-TP/"+code,"Generation Excel","menubar=no, status=no, scrollbars=yes, menubar=no, width=1200, height=800");
}
//***********************************************
// Filtre de recherche assure
function Loadlist1(){
if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	$("#content").load('adh/code.php');
}
//**********************************************

// Masquer les demandes annuler
function ddemanded(code){
if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
var ok=confirm("vous etes sur de supprimer cette demande");
if (ok){
xhr.open("GET", "demande/ddemanded.php?r0="+code, false);
xhr.send(null);
alert("Demande Supprimer!");
$("#content").load('demande/instanceec.php');
}
}
//**********************************************
// Imprimer la facture
function pfac(code){
if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
window.open("sortie/Facture-TP/"+code,"Generation Excel","menubar=no, status=no, scrollbars=yes, menubar=no, width=1200, height=800");
}
//**********************************************

// Generer les etats des demandes
function genere(){
var dated = dfrtoen(document.getElementById("dated").value);
var datef = dfrtoen(document.getElementById("datef").value);
var etat = document.getElementById("etat").value;

if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }  
window.open("sortie/Statistique/"+dated+"/"+datef+"/"+etat,"Etat-Statistique","menubar=no, status=no, scrollbars=yes, menubar=no, width=1000, height=1000");
}
//**********************************************