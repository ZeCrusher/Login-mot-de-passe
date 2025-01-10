<?php 
/* Login control.
 * (C) 2024 ZeCrusher
 *
 * Code source pour Odyssée ( Extranet V4)
 *
 */
	session_start();
?>

<!DOCTYPE html>
<html lang="fr" >
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<head>
        <title>Extranet - Odyssee</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Extranet Pro Odysse ZC - 2026"/>
        <meta name="keywords" content="Extranet"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>      
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Extranet Pro - 2026" />
        <meta property="og:site_name" content="Extranet Pro - 2026" />
        <link rel="shortcut icon" href="../../assets/media/logos/favicon.ico"/>

        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>        <!--end::Fonts-->
     
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="../../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
	<link href="../../assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
	<!--end::Global Stylesheets Bundle-->
        
<!-- V2024 -->
        
        <script>
            // Frame-busting pour empêcher le chargement du site dans un frame sans autorisation (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="app-blank" >
        <!--begin::Theme mode setup on page load-->
		<script>
			var defaultThemeMode = "light";
			var themeMode;

			if ( document.documentElement ) {
				if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
					themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
				} else {
					if ( localStorage.getItem("data-bs-theme") !== null ) {
						themeMode = localStorage.getItem("data-bs-theme");
					} else {
						themeMode = defaultThemeMode;
					}			
				}

				if (themeMode === "system") {
					themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
				}

				document.documentElement.setAttribute("data-bs-theme", themeMode);
			}            
		</script>
	<!--end::Theme mode setup on page load-->            
<!-- V2024 -->   
     
        <!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-up -->
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <!--begin::Header-->
            <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">          
                <!--Logo de l'Extranet 2024-->
                <a href="../../index.php" class="py-2 py-lg-20">
                    <img alt="Logo" src="../../assets/media/logos/logo_hibiscus-dark.png" class="h-40px h-lg-50px"/>                     
                </a>    
                <!--end::Logo-->

                <!--begin::Title-->
                <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">Bienvenue sur l'Extranet</h1>
               

                <!--end::Title-->

                <!--begin::Description-->
                <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                    Cet espace est destiné aux agents et services de<br/>
                    l'Office de Tourisme de Martigues
                </p>  
                <!--end::Description-->
            </div>
            <!--end::Header-->

            <!--begin::Illustration-->
            <div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-250px" 
                style="background-image: url(../../assets/media/illustrations/sketchy-1/17.png)"> 
            </div>
            <!--end::Illustration-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--begin::Aside-->

    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid py-10">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-600px p-10 p-lg-15 mx-auto">
				<!--begin::Form--> <!-- novalidate="novalidate" data-kt-redirect-url="index.php"  -->
				
		
				<!-- <form class="form w-100"  action="index.php"   id="kt_sign_up_form"> -->
              <form class="form" id="login_form">
			  
			  <div class="mb-10 text-center">
						<!--begin::Title-->
						<h1 class="text-dark mb-3">
							Me Connecter
						</h1>
						<!--end::Title-->      
						<!--begin::Link-->
						<div class="text-gray-400 fw-semibold fs-4">
							Vous n'avez pas de compte ?
							<a href="nouveau.php" class="link-primary fw-bold">C'est ici !</a>
						</div>
						<!--end::Link-->
					</div>
			  
			  <div class="d-flex align-items-center mb-10">
						<div class="border-bottom border-gray-300 mw-50 w-100"></div>
						<span class="fw-semibold text-gray-400 fs-7 mx-2">EXTRANET</span>
						<div class="border-bottom border-gray-300 mw-50 w-100"></div>
					</div>
			  

				
				<div class="fv-row mb-10">
                  <label for="email" class="form-label fs-6 fw-bolder text-dark">Votre adresse email </label>
                  <input	tabindex="1" style="border-color: #005F73;" class="form-control form-control-lg" type="text" name="email" id="email" required />
                </div>
				
				
                <div class="fv-row mb-10">
                  <div class="d-flex flex-stack mb-2">
                    <label	for="password"	class="form-label fw-bolder text-dark fs-6 mb-0" >Mot de passe</label>
                    <a href="../sign-in/password-reset.php" class="link-primary fs-6 fw-bold">Mot de passe oublié ?</a>
                  </div>
                  <div class="d-flex position-relative" data-kt-password-meter="true" >
                    <input id="password" style="border-color: #005F73;" class="form-control form-control-lg" type="password" name="password" tabindex="2" required />
                    
					<span class="btn btn-sm position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility"   >
                      <i class="bi bi-eye-slash d-none fs-2"></i>
                      <i class="bi bi-eye fs-2"></i>
                    </span>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" id="login_form_submit" tabindex="3" class="btn btn-lg btn-primary btn-gradient w-100 mb-5"                  >
                    <span class="indicator-label">Me connecter</span>
                    <span class="indicator-progress" >Veuillez patienter ...
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
					  </span>
                  </button>
                </div>
              </form>				<!--end::Form-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->       

        <!--begin::Footer-->
        <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
            <!--begin::Links 
            <div class="d-flex flex-center fw-semibold fs-6">
                <a href="https://www.martigues-tourisme.com " class="text-muted text-hover-primary px-2" target="_blank">Site Officiel</a>

                <a href="https://www.instagram.com/martiguestourisme/" class="text-muted text-hover-primary px-2" target="_blank">Instagram</a>
                
 
            </div>
             end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Body-->
</div>
<!--end::Authentication - Sign-up-->
</div>
<!--end::Root-->

	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="../../assets/plugins/global/plugins.bundle.js"></script>
		<script src="../../assets/js/scripts.bundle.js"></script>
		<script src="../../assets/js/fonctions.js"></script>
		<script src="../../assets/js/custom/authentication/sign-in/login.js"></script>
		
	</body>
    <!--end::Body-->
</html>

<?php
// 		┌───────────────────────────────────────────────────────────────────────────────────────────────┐
// 		│ tracage : Création d'un fichier dans /log/tracage.log qui sert de traceur AJAX         	│
// 		└───────────────────────────────────────────────────────────────────────────────────────────────┘
	
	function tracage($texte) {
		// Si on peut déterminer l'adresse IP
		$adresse_ip = Null;
		if(isset($_SERVER['REMOTE_ADDR'])) {
			$adresse_ip = '"'.$_SERVER['REMOTE_ADDR'].'"';
		}
		$txt_log=$adresse_ip.';'.date('d/m/Y H:i:s').';'.$texte."\n";
		// écriture dans un fichier de traçage
		// $fichier = "log/tracage_".date('Ymd').".log";
		$fichier = "tracage.txt";
		preg_match("`^(.*\/)([^\/]+)$`",$_SERVER['SCRIPT_FILENAME'], $matches);
		$chemin_script = $matches[1];
		$fichierCible = $chemin_script.$fichier;
		$myFile=fopen($fichierCible,'a+');
		fputs($myFile,$txt_log);
		fclose($myFile);
	}

?>
