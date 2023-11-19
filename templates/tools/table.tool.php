<?php
function generateTable($data, $columns, $actions = []) {
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    
    foreach ($columns as $column) {
        echo '<th>' . $column . '</th>';
    }
    
    if (!empty($actions)) {
        echo '<th>Action</th>';
    }
    
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    foreach ($data as $row) {
        echo '<tr>';
        
        foreach ($columns as $column) {
            if($column === 'Action' && $row['action'] !== false){
                continue;
            }
            echo '<td>' . $row[$column] . '</td>';
        }
        
        if ($row['action']) {
            echo '<td>';
            if(isset($row['actionBoutton'])){
                $actionBoutton = $row['actionBoutton'];
                foreach ($actionBoutton as $boutton ){
                    echo '<a href="' . $boutton['url'] . '"><i class="' . $boutton['icon'] . '"></i></a> ';
                }
            }else{
                echo '<a href="' . $row['url'] . '"><i class="' . $row['icon'] . '"></i></a> ';    
            }
            
            echo '</td>';
        }
        
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
}
// exemple d'utilisation
// $data = [
//     ['Nom' => 'John', 'Âge' => 30, 'Email' => 'john@example.com'],
//     ['Nom' => 'Jane', 'Âge' => 25, 'Email' => 'jane@example.com'],
//     ['Nom' => 'Bob', 'Âge' => 35, 'Email' => 'bob@example.com'],
// ];

// $columns = ['Nom', 'Âge', 'Email'];

// $actions = [
//     ['url' => 'edit.php', 'icon' => 'fa fa-edit'],
//     ['url' => 'delete.php', 'icon' => 'fa fa-trash'],
// ];

// generateTable($data, $columns, $actions);
?>