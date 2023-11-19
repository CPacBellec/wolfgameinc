<?php
fromInc('signup');
$labels = ['Nom', 'Prenom', 'Email','Adresse', 'Mot de passe', 'Confirmation mot de passe'];
$inputs = [
    ['id'=>'name','name'=>'name','type'=>'text','placeholder'=>'Entrez votre nom','required'=>true],
    ['id'=>'lastname','name'=>'lastname','type'=>'text','placeholder'=>'Entrez votre prenom','required'=>true],
    ['id'=>'email','name'=>'email','type'=>'email','placeholder'=>'Entrez votre adresse email','required'=>true],
    ['id'=>'address','name'=>'address','type'=>'text','placeholder'=>'Entrez votre adresse','required'=>false],
    ['id'=>'password','name'=>'password','type'=>'password','placeholder'=>'Entrez votre mot de passe','required'=>true],
    ['id'=>'password2','name'=>'password2','type'=>'password','placeholder'=>'Confirmez votre mot de passe','required'=>true]
];

fromTool('formulaire');

buildForm('Inscription',$labels, $inputs,"s'inscrire",'POST','#');
