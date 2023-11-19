<?php
fromInc('login');
$labels = ['Adresse email', 'Mot de passe'];
$inputs = [
    ['id' => 'email', 'name' => 'email', 'type' => 'email', 'placeholder' => 'Entrez votre adresse email',  'required' => true],
    ['id' => 'password', 'name' => 'password', 'type' => 'password', 'placeholder' => 'Entrez votre mot de passe',  'required' => true]
];

fromTool('formulaire');

buildForm('Connexion',$labels, $inputs,'Connexion','POST','#');
