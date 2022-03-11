<body>  

<?php $header = 'style/header.css';
require_once('header.php') ?> 
<link rel="stylesheet" href="style/profil.css">

<main>

    
<h1 class="h1profil">PROFIL DE</h1>

    <div class="box-profil">

            <form method ="post" action = "inscription.php" class="profito" >
            
                <div class="info">

                    <label>PRENOM</label>
                    <input type="text" name="login" placeholder='Arthur' required>

                    <label>NOM</label> 
                    <input type="text" name="login" placeholder='Smith' required>
                
                    <label>CIVILITE</label>
                    <input type="text" name="login" placeholder='Homme' required>
              
                </div>


                <div class="connexion">

                    <label>EMAIL</label> 
                    <input type="email" name="login" placeholder='Arthur@gmail.com' required>

                    <label>MOT DE PASSE</label> 
                    <input type="password" name="password" placeholder='*****' required>

                    <label>CONFIRMATION MOT DE PASSE</label> 
                    <input type="password" name="password" placeholder='*****' required>
               
                </div>


                <div class="adresse">

                    <label>ADRESSE</label> 
                    <input type="text" name="login" placeholder='36 rue des orfèvres' required>
                  
                    <label>CODE POSTALE</label> 
                    <input type="text" name="login" placeholder='75001' required>
                
                    <label>VILLE</label> 
                    <input  type="text" name="login" placeholder='Paris' required>
                
                </div>

    </div>

                <div class="pseudo">
                <label>PSEUDO</label>
                <input type="text" name="login" placeholder='Flyboard' required>
                </div>
                
                <div id="buttoncon"> <input class="inputinside" type="submit"value="Enregistrer"> </div> 

            </form>
   

        
 

</main>


<?php $footer = 'style/footer.css';
require_once('footer.php') ?>


<body>
</html>
