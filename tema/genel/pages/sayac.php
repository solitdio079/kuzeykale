<?php
$bugun			=	date("d"); // bugünün tarihi 
$ay				=	date("m"); // bu ay
$yil			=	date("Y"); // bu yıl 
$ip				=	$_SERVER['REMOTE_ADDR']; // ziyaretçinin ip si 
$hitsorgu = $db->prepare("SELECT COUNT(*) FROM hit WHERE ip = ? AND gun = ?");
$hitsorgu->execute(array($ip,$bugun));
$bugunGiris = $hitsorgu->fetchColumn();// bugün o ip ile girilmişmi 
if($bugunGiris!=0)
{ // yani bugün girilmişse
	$al	= $db->query("SELECT * FROM hit WHERE ip = '{$ip}' AND gun = '{$bugun}'")->fetch(PDO::FETCH_ASSOC);	
	$sorgu = $db->prepare("UPDATE hit SET
			sayac	= ?,
			simdi	= ?
			WHERE id = ?");
	$guncelle = $sorgu->execute(array(
			$al['sayac']+1,
			time(),
			$al['id']
		));
}
else
{ // griş yapılmamışsa kaydettirelim
	$sorgu = $db->prepare("INSERT INTO hit SET
		gun 	= ?,
		ay		= ?,
		yil 	= ?,
		simdi	= ?,
		sayac 	= ?,
		ip		= ?");
	$Ekle = $sorgu->execute(array(
		$bugun,
		$ay,
		$yil,
		time(),
		"1",
		$ip
		));
}
?>