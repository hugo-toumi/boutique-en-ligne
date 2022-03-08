<body>  

        <?php $header = 'style/header.css';
        require_once('header.php') ?> 
        <link rel="stylesheet" href="style/connexion.css">

        <main>

            <h1 class="h1conn">CONNEXION</h1>

                <form method ="post" action = "connexion.php" class="formi" >

                    <h3 class="h3email">EMAIL  
                    <input class="inputmain" type="text" name="login" placeholder='Arthur@gmail.com' required><br>
                    </h3> 

                    <h3 class="h3mdp">MOT DE PASSE
                    <input class="inputmain" type="password" name="password" placeholder='*****' required><br>
                    </h3> 

                    <div id="buttoncon"> <input class="inputcon" type="submit"value="Se connecter"> </div> 

                </form>

        </main>


        <?php $footer = 'style/footer.css';
        require_once('footer.php') ?> 


<body>
</html>

            <!-- <div class="message">
            <?php echo "<p class='msg'>". $message. '</p>' ; ?>
            </div> -->