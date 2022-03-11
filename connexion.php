
<body>  

<?php $header = 'style/header.css';
require_once('header.php') ?> 
<link rel="stylesheet" href="style/connexion.css">

<main>

<h1 class="h1conn">CONNEXION</h1>

        <div class="conni">

                <form method ="post" action = "connexion.php" class="formi">

                    <label>EMAIL</label> 
                    <input type="text" name="login" placeholder='Arthur@gmail.com' required>
                
                    <label>MOT DE PASSE </label> 
                    <input type="password" name="password" placeholder='*****' required>

                    </div>

                    <div id="buttoncon"> <input class="inputinside" type="submit"value="Se connecter"> </div> 

                </form> 

        </div>


        </main>


        <?php $footer = 'style/footer.css';
        require_once('footer.php') ?> 


<body>
</html>

            <!-- <div class="message">
            <?php echo "<p class='msg'>". $message. '</p>' ; ?>
            </div> -->