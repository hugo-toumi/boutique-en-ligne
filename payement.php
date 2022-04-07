
<?php

include('vendor/autoload.php');
        session_start();

        
         
            
            // Nous appelons l'autoloader pour avoir accès à Stripe
            $prix = (float) 42;

            // Nous instancions Stripe en indiquand la clé privée, pour prouver que nous sommes bien à l'origine de cette demande
            \Stripe\Stripe::setApiKey('sk_test_51KlW7ABFN5VA56amRmEGMRKj8mTML8or1cC6s8e5YcRPInrIwiAxxESCTQOHopIYCTbKJoT9RLDOa4W7vaOmI90p00etksu08k');

            // Nous créons l'intention de paiement et stockons la réponse dans la variable $intent
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $prix*100, // Le prix doit être transmis en centimes
                'currency' => 'eur',
            ]);


    



?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
        <link rel="stylesheet" href="style/paiement.css" type="text/css">
        <title>Paiement</title>

    </head>
    <body>
    <?php  echo " Le prix est de ".$price ."€";?>
    <form method="post">
    <div id="errors"></div>
    <input id="cardholder-name" type="text" placeholder="Titulaire de la carte">
    <div id="card-elements" class="test"></div>
    <div id="card-errors" role="alert"></div>
    <button id="card-button" type="button" data-secret="<?= $intent['client_secret'] ?>">Valider le paiement</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-2.0.2.min.js"></script>
    <script src="js/script.js"></script>
    </body>
</html>
