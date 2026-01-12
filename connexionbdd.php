<?php
    $user = 'blaise';
    $pass = 'Blaise1234!';

    try
    {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=prj_ticket;charset=utf8',
            $user,
            $pass
        );
    }
    catch(Exception $e)
    {
        echo 'Erreur:'.$e->getMessage();
    }
?>
