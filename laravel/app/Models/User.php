<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use PDO;

class User extends Authenticatable
{
    private static $connexion = null;

    private function __construct()
    {
        self::$connexion = new PDO('mysql:host=localhost;dbname=Safar', 'boss', 'azerty');
    }

    private static function getConnexion()
    {
        if (self::$connexion == null) {
            new User();
        }
        return self::$connexion;
    }

    public static function getConnexionP($email, $mdp)
    {
        $bd = self::getConnexion();
        $sql = "SELECT nom, prenom FROM client WHERE email = :email AND mdp = :mdp";
        $st = $bd->prepare($sql);
        $st->execute(array(':email' => $email, ':mdp' => $mdp));
        $client = $st->fetch(PDO::FETCH_ASSOC);
        $st->closeCursor();
        return $client;
    }

    public static function programmerSejour($ville_dep, $ville_arr, $tarif, $numHotel, $numResp)
    {
        $bd = self::getConnexion();
        $sql = 'insert into voyages values(:ville_depart, :ville_arriver, :tarif, :num_hotel, :num_responsable)';
        $st = $bd->prepare($sql);
        $st->execute(array(
            ':ville_depart'      => $ville_dep,
            ':ville_arriver'     => $ville_arr,
            ':tarif'             => $tarif,
            ':num_hotel'         => $numHotel,
            ':num_responsable'   => $numResp
        ));
        $st->closeCursor();
    }
}