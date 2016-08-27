<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Movie Or Parody</title>
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="js/libs/jquery/jquery.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <script src="jquery-ui.js" type="text/javascript"></script>
        <style>



        </style>

    </head>
    <body>

        <div id='cssmenu'>
            <ul>
                <li class='active'><a href='index.php'>Jeu</a></li>
                <li><a href='highscore.php'>Highscore</a></li>
                <li><a href='image_submit.php'>Soumettre une image</a></li>
            </ul>
        </div>
        <audio id="welcome" autoplay>
<source src="ressources/welcome.mp3" type="audio/mpeg" >
Your browser does not support the audio element.
</audio>
        <audio id="true_song">
<source src="ressources/yeah.wav" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
        <audio id="false_song">
<source src="ressources/wrong.wav" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
        <div id='board'>

            <div id='game'>
                <p> Bienvenue sur Movie Or Parody<br>
                    Le jeu complétement délirant</p>
                <p>Il y a actuellement <span style='color:blue' id='nb_im'></span> images.<br>
                    Montre que tu es le plus fort.</p>
                <img id='pictureG' src=''>

            </div>

            <div id='scoreS'>
                <div id='timer'>
                    <p>Timer<br>
                        <span id='time'>0</span></p>
                </div>
                <div id='score'>
                    <form method="POST" id="score_form" action="highscore.php">
                    <input type="hidden" name="score" value="">
                    <input type="hidden" name="time" value="">
                    <div id="score_diag" title="Highscore">
                        <label>Pseudo : </label><input type="text" name="pseudo" form="score_form" value="">
                        <button type="submit" form="score_form">Envoyer</button>
                    </div>
                    </form>
                    <p>Score<br>
                        <span class='score'>0</span></p>
                </div>
                <div id='joker'>
                    <p>Jokers</p>
                    <img id="agrandir" src="ressources/agrandir.png" title="Agrandir le rectangle visible"/><br>
                    <img id="pass" src="ressources/skip_b.png" title="Passer à l'image suivante"/>

                </div>

            </div>
            <div id="description">

            </div>
            <div id='buttons'>
                <button id='movieB'>Movie</button>
                <button id='parodyB'>Parody</button>
                <button id='jouer'>Commencer à jouer</button>
                <button id='highscore'>Add Highscore</button>
            </div>
        </div>

        <script>
            $(function() {
            var image_act = {};
            var score = 0;
            var nb_images = -10;
            var tab_id = new Array();
            tab_id[0] = 0;
            var centi = 0;
            var secon = 0;
            var minu = 0;
            var timer;
            function intro() {
                count_image();
                $('#score_diag').dialog({ autoOpen: false, }); //Crée une instance de la boîte de dialogue sans l'ouvrir
                $('#game p:first').animate({
                    opacity: '1',
                    fontSize: '55px', // ne pas oublier la syntaxe de l'identifiant !
                }, 1200, 'linear', function () {
                    $('#game p:last').animate({
                        opacity: '1',
                        fontSize: '55px', // ne pas oublier la syntaxe de l'identifiant !
                    }, 1200, 'linear', function () {
                        $("#jouer").css("display", "inline");
                        $("#jouer").click(function () {
                            ini_game();
                            main_game();
                            $("#game").css("background-color", "white");
                            $("#game p").hide();
                            timer = setInterval(Horloge, 100);

                        });
                    });
                });





            }
            function new_image() {

                $.ajax({
                    // chargement du fichier externe
                    url: "dbb_image.php",
                    // Passage des données au fichier externe (ici le nom cliqué)
                    data: {tab_id: tab_id},
                    cache: false,
                    dataType: "json",
                    error: function (request, error) { // Info Debuggage si erreur
                        alert("Erreur : responseText: " + request.responseText);
                    },
                    success: function (data) {
                        // Informe l'utilisateur que l'opération est terminé et renvoie le résultat



                        image_act = jQuery.extend({}, data);
                        var image = new Image();
                        image.src = image_act.src;
                        image_act.width = image.width;
                        image_act.height = image.height;
                        $("#pictureG").attr('src', image_act.src);
                        $("#pictureG").load(function () {

                            $("#pictureG").css('margin-left', ((800 - image.width) / 2));
                            $("#pictureG").css('margin-top', ((600 - image.height) / 2));

                            $("#pictureG").css('clip', 'rect(' + image_act.y1 + 'px,' + image_act.x2 + 'px,' + image_act.y2 + 'px,' + image_act.x1 + 'px)');

                            $("#pictureG").css("display", "inline");
                        });
                        tab_id.push(image_act.id);


                    }
                });


            }

            function count_image() {
                var tab = new Array();
                tab[0] = 1;
                $.ajax({
                    // chargement du fichier externe
                    url: "dbb_image.php",
                    // Passage des données au fichier externe (ici le nom cliqué)
                    data: {tab_id: tab},
                    cache: false,
                    dataType: "json",
                    error: function (request, error) { // Info Debuggage si erreur
                        alert("Erreur : responseText: " + request.responseText);
                    },
                    success: function (data) {
                        // Informe l'utilisateur que l'opération est terminé et renvoie le résultat

                        nb_images = data.nb;
                        $("#nb_im").html(nb_images);
                    }


                });
            }

            function ini_game() {
                $("#buttons #jouer").off("click");
                $("#agrandir").attr('src','ressources/agrandir.png');
                $("#agrandir").click(function () {
                        agrandir(30);
                    });
                    $("#pass").attr('src','ressources/skip_b.png');
                $("#pass").click(function () {
                        pass();
                    });
                score = 0;
                $('.score').html(score);
                tab_id = [];
                tab_id[0] = 0;




            }

            function main_game() {

                if ((tab_id.length) === (parseInt(nb_images) + 1)) {

                    end_game(true);
                }
                else {

                    new_image();
                    $("#buttons #parodyB, #movieB").css("display", "inline");
                    $("#buttons #jouer, #highscore").css("display", "none");
                    $("#buttons #parodyB, #movieB").click(function (event) {
                        verif_image(event.target)
                    });

                }

            }

            function verif_image(event) {
                $("#buttons #parodyB, #movieB").off("click");
                if (image_act.reality == 1) {

                    if ($(event).attr("id") == "movieB") {
                        full_description();
                        score_game();
                        $('#true_song').trigger("play");
                        setTimeout(function () {
                            main_game();
                        }, 3000);
                    }
                    else {
                        full_description();
                        $('#false_song').trigger("play");
                        setTimeout(function () {
                            end_game(false);
                        }, 3000);
                    }
                }
                else {

                    if ($(event).attr("id") == "parodyB") {
                        full_description();
                        score_game();
                        $('#true_song').trigger("play");
                        setTimeout(function () {
                            main_game();
                        }, 3000);
                    }
                    else {
                        full_description();
                        $('#false_song').trigger("play");
                        setTimeout(function () {
                            end_game(false);
                        }, 3000);

                    }
                }

            }

            function score_game() {
                score++;
                $('.score').html(score);

            }
            function end_game(win) {
                clearInterval(timer);
                $("#pictureG").css("display", "none");
                $("#pictureG").attr("src", "");
                $("#game").css("background-color", "#339900");
                if (win) {
                    $("#game p:first").html("Félicitation vous avez tout trouvé, <br>vous avez fait un score de <br><span style='font-size:80px; color:blue;' COLOR='blue' >" + score + "</span><br> Dans un temps de : <span style='font-size:80px; color:blue;' COLOR='green' >" + minu + " : " + secon + " : " + centi + "</span>");
                }
                else {

                    $("#game p:first").html("Malheureusement vous avez perdu, <br>vous avez fait un score de <br><span style='font-size:80px; color:blue;' COLOR='blue' >" + score + "</span><br> Dans un temps de : <span style='font-size:80px; color:blue;' COLOR='green' >" + minu + " : " + secon + " : " + centi + "</span>");
                }
                $("#game p:first").show();
                $("#parodyB, #movieB").css("display", "none");
                $("#jouer").text("Rejouer");
                $("#jouer, #highscore").css("display", "inline");
                $("#highscore").css("margin-left", "-40px");
                $("#jouer").css("margin-left", "-70px");
                $('input[name="score"]').val(score);
                $('input[name="time"]').val(minu + ":" + secon + ":" + centi);

                $("#jouer").click(function () {
                    ini_game();
                    main_game();
                    $("#game").css("background-color", "white");
                    $("#game p").hide();
                    centi = 0;
                    secon = 0;
                    minu = 0;
                    timer = setInterval(Horloge, 100);
                });
                $("#highscore").click(function () {
                   $('#score_diag').dialog('open'); // Ouvre la boîte de dialogue
                });
            }
            function full_description() {

                $('#pictureG').css('clip', 'auto');
                if (image_act.reality == 1) {
                    $("#description").html("<span style='border : solid 5px green ;  border-radius:7px; color: green; font-size:35px'>Movie   </span> &nbsp &nbsp  " + image_act.description);
                }
                else {
                    $("#description").html("<span style='border : solid 5px blue ; border-radius:7px; color: blue; font-size:35px'>Parody  </span> &nbsp &nbsp  " + image_act.description);
                }
                setTimeout(function () {
                    $("#description").html("");
                }, 3000);
            }

            function agrandir(taille) {
                $("#pictureG").css('clip', 'rect(' + (parseInt(image_act.y1) - taille) + 'px,' + (parseInt(image_act.x2) + taille) + 'px,' + (parseInt(image_act.y2) + taille) + 'px,' + (parseInt(image_act.x1) - taille) + 'px)');
                $("#agrandir").off("click");
                $("#agrandir").attr('src','ressources/agrandir_grey.png');
            }
            function pass(){
                 $("#pass").off("click");
                $("#pass").attr('src','ressources/skip_b_grey.png');
                if(image_act.reality==1){
                    $("#movieB").click();
                }
                else{
                $("#parodyB").click();
        }
            }

            function Horloge() {

                centi++; //incrémentation des dixièmes de 1
                if (centi > 9) {
                    centi = 0;
                    secon++
                } //si les dixièmes > 9,

                if (secon > 59) {
                    secon = 0;
                    minu++
                } //si les secondes > 59,

                $("#time").text(minu + " : " + secon + " : " + centi);

            }

intro();
});

        </script>
    </body>
</html>
