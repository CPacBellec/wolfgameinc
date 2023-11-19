<?php
fromInc('updateaddress');
$labels = ['addresse'];
$inputs = [
    ['id'=>'address','name'=>'address','type'=>'text','placeholder'=>'Entrez votre adresse','required'=>false],
];

fromTool('formulaire');

buildForm("Modifier l'adresse",$labels, $inputs,"Modifier",'POST','#',true);
