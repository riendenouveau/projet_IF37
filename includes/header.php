<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?? "Handi'Mov"?></title>
    <style>
    .contenu{
        margin: 100px 5% 80px 5%;
    }
    button {
    text-decoration: none;
    background-color:#003a73;
    border:1px solid #0a4683;
    color: white !important;
    font-weight: normal;
    padding: 12px 20px;
 }
 button:hover {
    text-decoration: none;
    background-color: #1d61a5;
    border:1px solid #1d61a5;
    color:white;  
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.30);
 }
 @font-face {
    font-family: 'louis_george_cafebold';
    src: url('font/louis_george_cafe_bold-webfont.woff2') format('woff2'),
         url('font/louis_george_cafe_bold-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'louis_george_cafeitalic';
    src: url('font/font/font/louis_george_cafe_italic-webfont.woff2') format('woff2'),
         url('font/font/font/louis_george_cafe_italic-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'louis_george_cafe_lightitalic';
    src: url('font/font/louis_george_cafe_light_italic-webfont.woff2') format('woff2'),
         url('font/font/louis_george_cafe_light_italic-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'louis_george_cafe_lightRg';
    src: url('font/louis_george_cafe_light-webfont.woff2') format('woff2'),
         url('font/louis_george_cafe_light-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'louis_george_caferegular';
    src: url('font/louis_george_cafe-webfont.woff2') format('woff2'),
         url('font/louis_george_cafe-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'louis_george_cafebold_italic';
    src: url('font/louis_george_cafe_bold_italic-webfont.woff2') format('woff2'),
         url('font/louis_george_cafe_bold_italic-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}

/*-------------POUR LES SCROLLBAR----------------------*/
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px rgba(51, 51, 51,0.5); 
  border-radius: 5px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgba(51, 51, 51,0.2);
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background:rgba(51, 51, 51, 0.8) ; 
}

/* ---------------------POLICE GENERALE DU SITE----------------------------------*/
h3, p , li{
        font-family: 'louis_george_caferegular';
    }
    

    #infoEtablissements{
        padding : 20px 20px;
    }

     h2 {
        /*color : #DA2127;*/
        /*font: normal 40px 'Cookie', cursive;*/
        font-family: 'louis_george_cafebold';
    }

/*---------------------------AUTRE ----------------------------------------*/
.clair {
    background-color:rgba(221, 231, 240, 0.5);
}

.partie{
    padding : 50px 10%;
}
</style>
</head>