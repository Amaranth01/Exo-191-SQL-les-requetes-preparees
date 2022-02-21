<?php

/**
 * Reprenez le code de l'exercice précédent et transformez vos requêtes pour utiliser les requêtes préparées
 * la méthode de bind du paramètre et du choix du marqueur de données est à votre convenance.
 */

try {

    $user = 'root';
    $password = '';
    $server = 'localhost';
    $db = 'table_test_php';

    $pdo = new PDO("mysql:host=$server; dbname=$db; charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nom = 'nom';
    $prenom = 'prenom';
    $email = 'emailll@.fr';
    $pswd = 'password';
    $rue = 'rue';
    $cp = 'code_postal';
    $ville = 'ville';

    $stm = $pdo->prepare(  "
        INSERT INTO utilisateur (nom, prenom, email, password, adresse, code_postal, pays)
        VALUES (:nom, :prenom, :email, :password ,:adresse, :code_postal, :pays)
    ");

    $stm->bindParam(':nom', $nom);
    $stm->bindParam(':prenom', $prenom);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':password', $pswd);
    $stm->bindParam(':adresse', $rue);
    $stm->bindParam(':code_postal', $cp, PDO::PARAM_INT);
    $stm->bindParam(':pays', $ville);

    $stm->execute();

    //produit

    $produit = 'produit';
    $prix = 'prix';
    $courte = 'courte';
    $longue = 'longue';

    $stm->bindParam('produit', $produit);
    $stm->bindParam('prix', $prix, PDO::PARAM_INT);
    $stm->bindParam('courte', $courte);
    $stm->bindParam('longue', $longue);

    $stm = $pdo->prepare( "
        INSERT INTO produit (produit, prix, courte, longue)
        VALUES ('sushi', 25.67, 'Du poisson cru', 'DU poisson cru sur du riz qui peut être avarié')
    ");

    $stm->execute();
}
catch (PDOException $e) {
    echo "Une erreur est survenue :" . $e->getMessage();
}