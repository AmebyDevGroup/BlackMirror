<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Page title -->
  <title>BlackMirror Inteligentne lustro - Panel zarzadzania</title>
  <!-- /Page title -->

  <!-- CSS Files
  ========================================================= -->
  <link href="css/style.css" rel="stylesheet">
  <!-- / CSS Files
  ========================================================= -->


  <!-- Favicon and Touch Icons
  ========================================================= -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="apple-touch-icon-144.png" rel="apple-touch-icon-precomposed" sizes="144x144">
  <link href="apple-touch-icon-114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
  <link href="apple-touch-icon-72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
  <link href="apple-touch-icon-57.png" rel="apple-touch-icon-precomposed">
  <!-- /Favicon
  ========================================================= -->
</head>
<!-- STYLE
========================================================= -->
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height:70vh;
    background-color: #000;
    background: url("background.jpg") no-repeat center center fixed;
     -webkit-background-size: cover;
     -moz-background-size: cover;
     -o-background-size: cover;
     background-size: cover;
  overflow: hidden;
}

h1 {
    position: relative;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: calc(20px + 5vw);
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    text-shadow: 0 0 0.15em #1da9cc;
    user-select: none;
    white-space: nowrap;
    filter: blur(0.007em);
    animation: shake 2.5s linear forwards;
}

h1 span {
    position: absolute;
    top: 0;
    left: 0;
    transform: translate(-50%, -50%);
    -webkit-clip-path: polygon(10% 0%, 44% 0%, 70% 100%, 55% 100%);
            clip-path: polygon(10% 0%, 44% 0%, 70% 100%, 55% 100%);
}

h1::before,
h1::after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
}

h1::before {
    animation: crack1 2.5s linear forwards;
    -webkit-clip-path: polygon(0% 0%, 10% 0%, 55% 100%, 0% 100%);
            clip-path: polygon(0% 0%, 10% 0%, 55% 100%, 0% 100%);
}

h1::after {
    animation: crack2 2.5s linear forwards;
    -webkit-clip-path: polygon(44% 0%, 100% 0%, 100% 100%, 70% 100%);
            clip-path: polygon(44% 0%, 100% 0%, 100% 100%, 70% 100%);
}

@keyframes shake {
    5%, 15%, 25%, 35%, 55%, 65%, 75%, 95% {
        filter: blur(0.018em);
        transform: translateY(0.018em) rotate(0deg);
    }

    10%, 30%, 40%, 50%, 70%, 80%, 90% {
        filter: blur(0.01em);
        transform: translateY(-0.018em) rotate(0deg);
    }

    20%, 60% {
        filter: blur(0.03em);
        transform: translate(-0.018em, 0.018em) rotate(0deg);
    }

    45%, 85% {
        filter: blur(0.03em);
        transform: translate(0.018em, -0.018em) rotate(0deg);
    }

    100% {
        filter: blur(0.007em);
        transform: translate(0) rotate(-0.5deg);
    }
}

@keyframes crack1 {
    0%, 95% {
        transform: translate(-50%, -50%);
    }

    100% {
        transform: translate(-51%, -48%);
    }
}

@keyframes crack2 {
    0%, 95% {
        transform: translate(-50%, -50%);
    }

    100% {
        transform: translate(-49%, -53%);
    }
}

.descrition
{
	margin-top:7%;
	font-size:100px;
	position:absolute;
	font-family: 'Montserrat', Arial, sans-serif;
    font-size: calc(10px + 1vw);
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    text-shadow: 0 0 0.15em #1da9cc;
    user-select: none;
    white-space: nowrap;
    filter: blur(0.007em);
}
.przycisk
{
	margin-top:11%;
	font-size:100px;
	position:absolute;
}

.btn-link {
  font-family: 'Montserrat', Arial, sans-serif;
    text-transform: uppercase;
    text-shadow: 0 0 0.15em #1da9cc;
    user-select: none;
    white-space: nowrap;
    filter: blur(0.007em);
  position: relative;
  display: inline-block;
  color: #fff;
  font-size: 24px;
  letter-spacing: 0.02em;
  text-decoration: none;
  z-index: 1;
}
.btn-link:before,
.btn-link:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
.btn-link:before {
  background-color: #00ffff;
  z-index: -1;
}
.btn-link:after {
  background-color: #fff;
  z-index: -2;
}
.btn-link:hover .link-inner {
  -webkit-animation: glitchy 0.3s ease 1;
          animation: glitchy 0.3s ease 1;
}
.btn-link:hover:before {
  -webkit-animation: glitchy 0.3s ease 0.3s infinite;
          animation: glitchy 0.3s ease 0.3s infinite;
}
.btn-link:hover:after {
  animation: glitchy 0.3s ease infinite reverse;
}
.link-inner {
  display: block;
  height: 100%;
  background-color: #30302f;
  padding: 10px 15px;
}
@-webkit-keyframes glitchy {
  0% {
    -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
  }
  25% {
    -webkit-transform: translate(-2px, -2px);
            transform: translate(-2px, -2px);
  }
  50% {
    -webkit-transform: translate(2px, 2px);
            transform: translate(2px, 2px);
  }
  75% {
    -webkit-transform: translate(2px, -2px);
            transform: translate(2px, -2px);
  }
  100% {
    -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
  }
}
@keyframes glitchy {
  0% {
    -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
  }
  25% {
    -webkit-transform: translate(-2px, -2px);
            transform: translate(-2px, -2px);
  }
  50% {
    -webkit-transform: translate(2px, 2px);
            transform: translate(2px, 2px);
  }
  75% {
    -webkit-transform: translate(2px, -2px);
            transform: translate(2px, -2px);
  }
  100% {
    -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
  }
}

</style>

<!-- /STYLE
========================================================= -->
<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAC7u7sAAAAAAERERACIiIgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEREREREREREREREREREREREREREREREREREzMzMzEREREzMDAAAxERETMzAwADERERMDMwMAMREREwAzMDAxERETAAMzAzERERMwADMwMREREwMAAzMxERETADAAMzEREREzMzMzEREREhEREREhERERIiIiIhERERERERERERHAAwAA//8AAPAPAADgBwAAwAMAAMADAADAAwAAwAMAAMADAADAAwAAwAMAAMADAADAAwAAwAMAAOAHAADwDwAA" rel="icon" type="image/x-icon" />

<!-- CONTENT
========================================================= -->
<body>
<h1 data-text="black mirror"><span>black mirror</span></h1>
<div class="descrition">
PROJEKT INTELGENTNEGO LUSTRA
</div>
 <div class="przycisk">
	<a href="{{route('admin')}}" class="btn-link"> <span class="link-inner">LOGOWANIE</span></a>
</div>

<!-- /CONTENT
========================================================= -->

<!-- Javascript Files
========================================================= -->
<script src=""></script>



</body>
</html>
