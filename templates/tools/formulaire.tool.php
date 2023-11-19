<?php
function buildForm($title,$labels, $inputs, $submit = 'Soumettre',$method = 'POST',$action = '#', $address = false) {
    if (count($labels) !== count($inputs)) {
        echo "Erreur : Les tableaux de labels et d'inputs ne sont pas de même taille.";
        return;
    }
    echo '<main class="flex-shrink-0">';
    echo '<div class="row">';
    echo '<div class="container rounded bg-light col-7">';
    echo '<div class="h4 pb-2 mb-4  border-bottom border-secondary text-center">';
    echo $title;
    echo '</div>';
    echo '<div class="row g-5 ">';
    echo '<div class="col-md-12 col-lg-12 ">';
    
    echo '<form method = "'.$method.'" action="'.$action.'"  enctype="multipart/form-data" >';
    echo '<div class="row ">';

    for ($i = 0; $i < count($labels); $i++) {
        $label = $labels[$i];
        $input = $inputs[$i];
        $inputrRequired = isset($input['required']) && $input['required'] == true ? 'required' : '';
        $inputName = $input['name'];

        echo '<div class="form-group col-12  mx-auto mb-3">';
        echo '<label  for="' . $input['id'] . '">' . $label ;
        if($inputrRequired === 'required'){
            echo '<span class="';
            if ($method === 'POST') {
                echo isset($_POST["submit"]) ? (empty($_POST[$inputName]) ?  "text-danger" :  "") :  "";
            } elseif ($method === 'GET') {
                echo isset($_GET["submit"]) ? (empty($_GET[$inputName]) ?  "text-danger" :  "") :  "";
            }
            echo '">*</span>';
        }
        echo '</label>';
        
        // Vérification du type d'input (text, email, etc.)
        $inputType = isset($input['type']) ? $input['type'] : 'text';
        $inputID = $input['id'];
        $inputPlaceholder = isset($input['placeholder']) ? $input['placeholder'] : '';

        //checkbox, textarea, select
        if($inputType === "checkbox"){
            echo '<div class="form-check">';
            echo '<input class="form-check-input"';
            if($inputrRequired === 'required'){
                if ($method === 'POST') {
                    echo isset($_POST["submit"]) ? (empty($_POST[$inputName]) ?  "is-invalid" :  "") :  "";
                } elseif ($method === 'GET') {
                    echo isset($_GET["submit"]) ? (empty($_GET[$inputName]) ?  "is-invalid" :  "") :  "";
                }
            }
            echo ' type="checkbox" id="'.$inputID.'" name="'. $inputName .'"';
            if(isset($_POST['submit']) || isset($_GET['submit'])){
                if ($method === 'POST') {
                    echo  (isset($_POST[$inputName]) ?  "checked" :  "");
                } else if ($method === 'GET') {
                    echo (isset($_GET[$inputName]) ?  "checked" :  "");
                }
            }
            else if(isset($input['value'])){
                echo "checked";
            }
            echo '>';
            echo '</div>';
        }else if($inputType === "textarea"){
            echo '<textarea id="'.$inputID.'" class="form-control ';
            if($inputrRequired === 'required'){
                if ($method === 'POST') {
                    echo isset($_POST["submit"]) ? (empty($_POST[$inputName]) ?  "is-invalid" :  "") :  "";
                } elseif ($method === 'GET') {
                    echo isset($_GET["submit"]) ? (empty($_GET[$inputName]) ?  "is-invalid" :  "") :  "";
                }
            }
            echo '" name="'. $inputName .'" placeholder="'.$inputPlaceholder.'" '.$inputrRequired.'>';
            if(isset($_POST['submit']) || isset($_GET['submit'])){
                if ($method === 'POST') {
                    echo  (isset($_POST[$inputName]) ?  $_POST[$inputName] :  "");
                } elseif ($method === 'GET') {
                    echo (isset($_GET[$inputName]) ?  $_GET[$inputName] :  "");
                }
            }else if(isset($input['value'])){
                echo $input['value'];
            }
            echo '</textarea>';

        }else if($inputType === "select"){
            echo '<select class="form-select ';
            if($inputrRequired === 'required'){
                if ($method === 'POST') {
                    echo isset($_POST["submit"]) ? (empty($_POST[$inputName]) ?  "is-invalid" :  "") :  "";
                } elseif ($method === 'GET') {
                    echo isset($_GET["submit"]) ? (empty($_GET[$inputName]) ?  "is-invalid" :  "") :  "";
                }
            }
            echo '" id="' . $inputID . '" name="' . $inputName . '"  ';
            
            echo ' '.$inputrRequired.'>';
            foreach($input['option'] as $optionKey => $option){ 
                echo '<option value="'.$optionKey.'"';
                if(isset($_POST['submit']) || isset($_GET['submit'])){
                    if ($method === 'POST' && isset($_POST[$inputName]) && $_POST[$inputName] === $optionKey) {
                        echo  (isset($_POST[$inputName]) ? "selected" :  "");
                    } elseif ($method === 'GET' && isset($_GET[$inputName]) && $_GET[$inputName] === $optionKey ) {
                        echo (isset($_GET[$inputName]) ? "selected" :  "");
                    }
                }else if(isset($input['value']) && $optionKey === $input['value']){
                    echo "selected";
                }
                echo '>'.$option.'</option>';
            }
            echo '</select>';

        }else if($inputType === "file"){
            echo '<input type="' . $inputType . '" class="form-control ';
            if($inputrRequired === 'required'){
                echo isset($_POST["submit"]) ? (empty($_FILES[$inputName]['tmp_name']) ?  "is-invalid" :  "") :  "";  
            }
            echo '" id="' . $inputID . '" name="' . $inputName . '' ;
            echo '" '.$inputrRequired.'>';
        }else{
            echo '<input type="' . $inputType . '" class="form-control ';
            if($inputrRequired === 'required'){
                if ($method === 'POST') {
                    echo isset($_POST["submit"]) ? (empty($_POST[$inputName]) ?  "is-invalid" :  "") :  "";
                } elseif ($method === 'GET') {
                    echo isset($_GET["submit"]) ? (empty($_GET[$inputName]) ?  "is-invalid" :  "") :  "";
                }
            }
            echo '" id="' . $inputID . '" name="' . $inputName . '" placeholder="' . $inputPlaceholder . '" value="';
            if(isset($_POST['submit']) || isset($_GET['submit'])){
                if ($method === 'POST') {
                    echo  (isset($_POST[$inputName]) && $inputName !== 'password' && $inputName !== 'password2' && $inputName !=="oldpassword" ?  $_POST[$inputName] :  "");
                } elseif ($method === 'GET') {
                    echo (isset($_GET[$inputName]) ?  $_GET[$inputName] :  "");
                }
            }else if($address){
                echo $_SESSION['user_address'];
            }else if(isset($input['value'])){
                echo $input['value'];
            }else{
                echo "";
            }
           
            echo '"';
            if(isset($input['min'])){
                echo ' min="'.$input['min'].'"';
            }
            if(isset($input['max'])){
                echo ' max="'.$input['max'].'"';
            }
            echo ''.$inputrRequired.'>';
        }
        
        echo '</div>';
    }
    echo '</div>';
    
    echo '<input type="submit" class="w-100 btn btn-primary btn-lg mr-3 mb-3 " name="submit" value="'.$submit.'">';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</main>';
}

// Exemple d'utilisation
// $labels = ['Nom', 'Adresse email', 'Mot de passe'];
// $inputs = [
//     ['id' => 'nom', 'name' => 'nom', 'type' => 'text', 'placeholder' => 'Entrez votre nom', 'required' => true],
//     ['id' => 'email', 'name' => 'email', 'type' => 'email', 'placeholder' => 'Entrez votre adresse email',  'required' => true],
//     ['id' => 'password', 'name' => 'password', 'type' => 'password', 'placeholder' => 'Entrez votre mot de passe',  'required' => true]
// ];
//fromTool('formulaire');

// buildForm('Connexion',$labels, $inputs, $submit = 'Connexion',$method = 'POST',$action = '#');
