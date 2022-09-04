<?php
require("cnx.php");
$idC=$_POST['Idcompte'];
$categorieC=$_POST['categorieC'];
$typeCred=$_POST['typecredit'];
$freq=$_POST['frequence'];
$motAc=$_POST['MontantAccorde'];
$taux=$_POST['TauxInteret'];
$mot=$_POST['Motif'];
$dev=$_POST['Devise'];
$echea=$_POST['Echeance'];
$duree=$_POST['dureeJ'];
$date=$_POST['DateCred'];
$dateTombee=$_POST['dateTombee'];
$dates = array($dateTombee);
//GENERE UN NUMERO DE CREDIT
$ps=$pdo->prepare("INSERT INTO compteur_credit(fakeId) VALUES(?)");
$params=array("0000");
$ps->execute($params);

$LastIdCredit=$pdo->prepare("SELECT * FROM compteur_credit ORDER BY id DESC LIMIT 1");
$LastIdCredit->execute();
$result=$LastIdCredit->fetch(PDO::FETCH_OBJ);
$NumCredit="CR000".$result->id;

$ps=$pdo->prepare("INSERT INTO credit(idcompte,NumDossier,categorieC,typecred,frequenceRemb,montantAcorde,interet,motif,devise,echeance,dureeJour,dateCred,dateTombee) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$categorieC,$typeCred,$freq,$motAc,$taux,$mot,$dev,$echea,$duree,$date,$dateTombee);
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
	if($categorieC=="A")
	{
	if($dev=="USD")
	{
	if($motAc<=300)
	{
	if($taux=="2,5")
	{
	if($echea=="6")
	{
	if($duree=="180")
	{
if($ps->execute($params))
{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);

$req=$pdo->query("DELETE FROM echeanciers WHERE statutPayement=0 AND CapAmmorti=0 AND Interet=0 AND DateTranch='$date'");
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
if ($categorieC=="B") 
		{
			if($dev=="USD")
			{
			if($motAc<=10000)
			{
			if($taux=="2,5")
			{
			if($echea=="9")
			{
			if($duree=="270")
			{
				if($ps->execute($params))
				{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
if ($categorieC=="C") 
		{
			if($dev=="USD")
			{
			if($motAc<=20000)
			{
			if($taux=="2,5")
			{
			if($echea=="12")
			{
			if($duree=="365")
			{
				if($ps->execute($params))
				{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
if ($categorieC=="D") 
		{
			if($dev=="USD")
			{
			if($motAc<=80000)
			{
			if($taux=="3")
			{
			if($echea=="24")
			{
			if($duree=="730")
			{
				if($ps->execute($params))
				{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
//francs
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
if($categorieC=="A")
{
	if($dev=="CDF")
	{
	if($motAc<=600000)
	{
	if($taux=="2,5")
	{
	if($echea=="6")
	{
	if($duree=="180")
	{
if($ps->execute($params))
{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
if ($categorieC=="B") 
		{
			if($dev=="CDF")
			{
			if($motAc<=20000000)
			{
			if($taux=="2,5")
			{
			if($echea=="9")
			{
			if($duree=="270")
			{
				if($ps->execute($params))
				{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
if ($categorieC=="C") 
		{
			if($dev=="CDF")
			{
			if($motAc<=40000000)
			{
			if($taux=="2,5")
			{
			if($echea=="12")
			{
			if($duree=="365")
			{
				if($ps->execute($params))
				{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
$res=$pdo->query("SELECT sum(montant) as Solde FROM mouvement WHERE idcompte='$idC'");
while($solde=$res->fetch())
{
	if($solde['Solde']>=1)
	{
if ($categorieC=="D") 
		{
			if($dev=="CDF")
			{
			if($motAc<=160000000)
			{
			if($taux=="3")
			{
			if($echea=="24")
			{
			if($duree=="730")
			{
						if($ps->execute($params))
				{
	//GENERE L'ECHEANCIER
$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$echea,$motAc,0,0,0,$motAc,$date,0);
$ps->execute($params);

for ($i = 2; $i < $echea+1; $i++) {
$NewDate = date('Y-m-d', strtotime("+" . $i . "month", strtotime("$date")));
$dates[] = $NewDate;

}

foreach($dates as $dt){
$capital = $motAc;
$capitalAmorti = $capital /$echea;
$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
$interetApayer = $lastRowData->Capital * $taux / 100;
$totalAp = $interetApayer + $capitalAmorti;

$ps=$pdo->prepare("INSERT INTO echeanciers(idcompte,NumDossier,NbreJour,Capital,Interet,CapAmmorti,TotalAp,Cumul,DateTranch,statutPayement) VALUES(?,?,?,?,?,?,?,?,?,?)");
$params=array($idC,$NumCredit,$lastRowData->NbreJour-1,$lastRowData->Capital-$capitalAmorti,$interetApayer,$capitalAmorti,$capitalAmorti+$interetApayer,$lastRowData->Capital-$capitalAmorti,$dt,0);
$ps->execute($params);

$getLastRow=$pdo->query("SELECT * FROM echeanciers ORDER BY ReferenceEch DESC LIMIT 1");
$lastRowData=$getLastRow->fetch(PDO::FETCH_OBJ);
header("location:credit.php");
}
}
}
}
}
}
}
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<title></title>
</head>
<body style="background-color:lightblue;">
	<br><br><br><br><br><br><br><br><br><br><br>
	<p style="text-align:center; font-size:50px;color:red;">Erreur</p>
	<div class="container">
<div class="alert-danger text-center fw-bold" role = "alert" style=" font-size:20px;">vérifiez les données saisies, soit:</br>-le montant ne correspond à la categorie du compte<br>-l'écheance ne correspond à la catégorie du compte</br>- les nombres des jours ne correspondent pas à l'écheance</div>
</div>
</body>
</html>