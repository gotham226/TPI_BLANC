<?php
require_once('database.php');



function selectAllProductByDate(){
    $sql = "SELECT * FROM caps ORDER BY id_cap DESC";
    $data = [
        
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function selectAllProductByBrand(){

    $sql = "SELECT * FROM caps ORDER BY brand";
    $data = [
        
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function selectAllProductByPrice(){

    $sql = "SELECT * FROM caps ORDER BY price";
    $data = [
        
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function SelectProductLike($search){
    $sql = "SELECT * FROM caps WHERE model LIKE ?";
    $data = [
        "%$search%",
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function SelectProductById($idCap){
    $sql = "SELECT * FROM caps WHERE id_cap = ?";
    $data = [
        $idCap
    ];
    return dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
}

function SelectProductLikeBrand($search){
    $sql = "SELECT * FROM caps WHERE brand LIKE '%$search%'";
    
    return dbRun($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function selectAllProductByFavorite($idUser){
    $products = [];

    $sql = "SELECT id_cap FROM favorite WHERE id_user = ? ";

    $data = [
        $idUser
    ];
    
    $idsCap = dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);

    if($idsCap != []){
        foreach ($idsCap as $idCap) {
            array_push($products, SelectProductById($idCap['id_cap']));
        }
    }
    return $products;
}

function AddFavoritCap($idCap, $idUser){
    $sql = "INSERT INTO favorite(id_user, id_cap) VALUES (?, ?);";
    $data = [            
        $idUser,             
        $idCap
    ];
    return dbRun($sql, $data);
}

function ChekIfTheCapIsFavorite($idCap, $idUser){
    $sql = "SELECT * FROM favorite WHERE id_cap = ? AND id_user = ?";
    $data = [
        $idCap,
        $idUser
    ];
    return dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
}

function RemoveFavoritCap($idCap, $idUser){
    $sql = "DELETE FROM favorite WHERE id_cap = ? AND id_user = ?";
    $data = [
        $idCap,
        $idUser
    ];

    dbRun($sql, $data); 
}

function AddProduct($nomImage, $model, $marque, $description, $prix, $quantity, $fichier){
    $uploads_dir = './img';
    try {
        
        $transactionStarted = false;
        if (!connexionDB()->inTransaction()) {
            connexionDB()->beginTransaction();
            $transactionStarted = true;
        }
        
        $sql = "INSERT INTO caps(price, description, quantity, brand, model, image) VALUES (?, ?, ?, ?, ?, ?);";
        $data = [            
            $prix,            
            $description,
            $quantity,
            $marque,
            $model,
            $nomImage 
        ];
        dbRun($sql, $data);
        if ($transactionStarted) {
            connexionDB()->commit();
        }
        if(move_uploaded_file($fichier['tmp_name'][0], "$uploads_dir/$nomImage")){
            $message = "Votre casquette a bien été ajoutée";
        }
        else{
            throw new Exception();
        }

        return $message;

    }catch (Exception $e) {
    connexionDB()->rollBack();
    throw $e;
    }
}

function UpdateCap($oldNameImage,$nomImage, $model, $marque, $description, $prix, $quantity, $idCap, $fichier){
    $uploads_dir = './img';
    try {
        
        $transactionStarted = false;
        if (!connexionDB()->inTransaction()) {
            connexionDB()->beginTransaction();
            $transactionStarted = true;
        }
        
        $sql = "UPDATE caps SET price = ?, description = ?, quantity = ?, brand = ?,  model = ?, image = ? WHERE id_cap = ?";

        $data=[
            $prix,
            $description,
            $quantity,
            $marque,
            $model,
            $nomImage,
            $idCap
        ];
        
        dbRun($sql, $data);
        if ($transactionStarted) {
            connexionDB()->commit();
        }
        if(unlink("$uploads_dir/$oldNameImage")){
            if(move_uploaded_file($fichier['tmp_name'][0], "$uploads_dir/$nomImage")){
                $message = "Votre casquette a bien été ajoutée";
            }
        }
        else{
            throw new Exception();
        }

        return $message;

    }catch (Exception $e) {
    connexionDB()->rollBack();
    throw $e;
    }
}

function UpdateCapWhitoutImage($model, $marque, $description, $prix, $quantity, $idCap){
    try {
        
        $transactionStarted = false;
        if (!connexionDB()->inTransaction()) {
            connexionDB()->beginTransaction();
            $transactionStarted = true;
        }
        
        $sql = "UPDATE caps SET price = ?, description = ?, quantity = ?, brand = ?,  model = ? WHERE id_cap = ?";

        $data=[
            $prix,
            $description,
            $quantity,
            $marque,
            $model,
            $idCap
        ];
        
        dbRun($sql, $data);
        if ($transactionStarted) {
            connexionDB()->commit();
        } 

        return "Votre casquette à bien été modifiée";

    }catch (Exception $e) {
    connexionDB()->rollBack();
    throw $e;
    }
}

function DeleteCap($idCap){

    $sql = "DELETE FROM favorite WHERE id_cap = ?";
    $data = [
        $idCap,
    ];

    dbRun($sql, $data); 

    $sql = "SELECT id_order FROM order_caps WHERE id_cap = ?";
    $data = [
        $idCap
    ];

    $idsOrder = dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    var_dump($idsOrder);
    
    $sql = "DELETE FROM order_caps WHERE id_cap = ?";
    $data = [
        $idCap,
    ];

    dbRun($sql, $data); 

    $sql = "DELETE FROM caps WHERE id_cap = ?";
    $data = [
        $idCap,
    ];
    dbRun($sql, $data); 

    foreach($idsOrder as $idOrder){
        $sql = "DELETE FROM orders WHERE id_order = ?";
        $data = [
            $idOrder
        ];
        var_dump($idOrder);

        dbRun($sql, $data); 
    }


}

