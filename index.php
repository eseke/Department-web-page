<head>
    <!--
    Header svake stranice sadrzi naziv stranice, putanje do fajlova od kojih zavisi. I skripte za pokretanje ugradjenih elemenata.
    -->
    <title>Početna</title>

    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/css/splide.min.css">
    <link rel="stylesheet" href="style/style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js"></script>
    <script>
	document.addEventListener( 'DOMContentLoaded', function () {
        new Splide( '.splide',{
        'cover'      : true,
        'heightRatio': 6/9,
        'autoplay': true,
        'interval': 2000,
        'rewind': true
        }
        ).mount();
    } );
    </script>
</head>

<body>
    <div class='container'>
<?php
    session_start();
    header('Content-type: text/html; charset=utf-8');
    include('include/header.php');
    include('include/login.php');
    include('include/menu.html');
    ?>
    <div class='row' >
        <div class='col-sm-12' id='ipsum'>
            <h2>O katedri</h2>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ornare arcu dui vivamus arcu felis bibendum ut tristique et. Nulla malesuada pellentesque elit eget gravida cum sociis natoque. 
        Nibh sit amet commodo nulla facilisi nullam. Faucibus purus in massa tempor nec feugiat. Ultricies leo integer malesuada nunc 
        vel risus commodo viverra maecenas. Mauris commodo quis imperdiet massa tincidunt. Vitae elementum curabitur vitae nunc. 
        Eget mauris pharetra et ultrices neque. Accumsan sit amet nulla facilisi morbi tempus iaculis. Amet dictum sit amet justo donec 
        enim diam vulputate ut. Venenatis a condimentum vitae sapien pellentesque habitant morbi. Proin fermentum leo vel orci porta non 
        pulvinar neque. Amet nulla facilisi morbi tempus iaculis.
        </div>
    </div>
    <!---
    U nastavku se nalazi slajder sa slikama.
    -->
    <div class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide"><img src="https://www.etf.bg.ac.rs/uploads/attachment/slajd/4/large__8963_2010___stanoje.radulovic_gmail.com.JPG"></li>
                <li class="splide__slide"><img src="https://www.etf.bg.ac.rs/uploads/attachment/slajd/2/large__9071_2010___stanoje.radulovic_gmail.com.JPG"></li>
                <li class="splide__slide"><img src="https://www.etf.bg.ac.rs/uploads/attachment/slajd/3/large_Picture_026.jpg"></li>
            </ul>
        </div>
    </div>
    <?php
    include('include/footer.html');
    ?>
    </div>
    
</doby>