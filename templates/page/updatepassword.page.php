<?php
fromInc('updatepassword');
$labels = ['Mot de passe actuel','Mot de passe', 'Confirmation mot de passe'];
$inputs = [
    ['id'=>'oldpassword','name'=>'oldpassword','type'=>'password','placeholder'=>'Entrez votre mot de passe actuel','required'=>true],
    ['id'=>'password','name'=>'password','type'=>'password','placeholder'=>'Entrez votre mot de passe','required'=>true],
    ['id'=>'password2','name'=>'password2','type'=>'password','placeholder'=>'Confirmez votre mot de passe','required'=>true]
];

fromTool('formulaire');

buildForm("Modifier le mot de passe",$labels, $inputs,"Modifier",'POST','#');
