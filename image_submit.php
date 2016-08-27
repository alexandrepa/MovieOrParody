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
            #cssmenu ul{
                padding-left:640px;
            }
            #soumettre{
                width:900px;
                margin : 0 auto;
                text-align:center;
                font-size: 30px;
    font-family: "Pacifico";
    border-radius: 22px 22px 22px 22px;
    -moz-border-radius: 22px 22px 22px 22px;
    -webkit-border-radius: 22px 22px 22px 22px;
    border: 7px solid #339900;
    background-color: white;
            }
            #div_image{
                margin : 0 auto;
            }
            #resizable {
                width: 50px; height: 50px;
                border : solid 3px;
            }
        </style>
    </head>
    <body>
         <div id='cssmenu'>
            <ul>
                <li><a href='index.php'>Jeu</a></li>
                <li><a href='highscore.php'>Highscore</a></li>
                <li class='active'><a href='#'>Soumettre une image</a></li>
            </ul>
        </div>
        <div id="soumettre">
             <form id="image_form" method="post" action="upload.php" enctype="multipart/form-data">
            <label>Description :</label>
            <textarea name="description" rows="4" cols="80" required></textarea><br>
            <input type=radio name="movieorparody" value="movie"> Movie

<input type=radio name="movieorparody" value="parody" required> Parody <br>
    <input type="file" name="image" accept="image/*" data-max-size="200000" required>
    <input type='hidden' name='x1' value=''>
    <input type='hidden' name='x2' value=''>
    <input type='hidden' name='y1' value=''>
    <input type='hidden' name='y2' value=''>
    <button type="submit">Envoyer</button>
</form>
            <div id="div_image" >

        <div id="resizable" >
            </div>
            </div>




        </div>
        <script>
            var resposition;
            var resize =new(Object);
           $('#image_form').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire

        $('input[name="x1"]').val(resposition.left);
        $('input[name="x2"]').val(resposition.left+resize.width);
        $('input[name="y1"]').val(resposition.top);
        $('input[name="y2"]').val(resposition.top+resize.height);





    });


             $('#soumettre').find('input[name="image"]').on('change', function (e) {
        var files = $(this)[0].files;

        if (files.length > 0) {
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
                $image_preview = $('#soumettre');

            // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
            //$image_preview.find('.thumbnail').removeClass('hidden');
            var imageUrl =window.URL.createObjectURL(file);
            var image = new Image();
            image.src = imageUrl;

            $(image).load(function () {
            $("#div_image").css('width',image.width);
            $("#div_image").css('height',image.height);
            $('#div_image').css('background-image', 'url(' + imageUrl + ')');

            $( "#resizable" ).show();
            $( "#resizable" ).draggable({containment: "#div_image",
                drag: function(event,ui){
                    resize.width=$(this).width();
                    resize.height=$(this).height();
      resposition = ui.position;

   }

    })
            .resizable({
      containment: "#div_image",
      resize: function(event,ui){
          resize=ui.size;
      resposition = ui.position;

   }
    });

        });


        }
    });
    $( "#resizable" ).hide();


            </script>
    </body>
</html>
