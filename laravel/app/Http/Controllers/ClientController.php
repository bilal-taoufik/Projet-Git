<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


Class ClientController extends Controller {
    
    public function ConnexionClient(Request $request) {
        $login = $request->input('email'); 
        $mdp = $request->input('mdp');
    

        return view('ConnexionClient');
    }
    

    public function ConnecterClient (){
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $client = User::getConnexionP($email, $mdp);

        
        if($client != FALSE){
            session_start();

            $_SESSION["nom"] = $client["nom"] ; 
            $_SESSION["prenom"] = $client["prenom"];

            //header("Location: /");
            return view('ConnecterClient');

        }
        else{
            printf('Identfiant ou mot de passe incorrect.');
            return view('ConnexionClient');
        }
    }
}
?>