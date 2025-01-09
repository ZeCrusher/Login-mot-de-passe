"use strict";
var KTPasswordResetNewPassword = function() {
	var e, t, r, o, s = function() {
		return 100 === o.getScore()
	};
	return {
		init: function() {
			
			var email = sessionStorage.getItem("email");
			console.log("New Password.js");  
			console.log(email);  
		
			e = document.querySelector("#kt_new_password_form"), 
				t = document.querySelector("#kt_new_password_submit"), 
				o = KTPasswordMeter.getInstance(e.querySelector('[data-kt-password-meter="true"]')), 
				r = FormValidation.formValidation(e, {
				fields: {
					password: {
						
						validators: {
							notEmpty: {
								message: "Le mot de passe est obligatoire"
							},
							callback: {
								message: "Veuillez entrer un mot de passe valide",
								callback: function(e) {
									if (e.value.length > 0) return s()
								}
							}
						}
					},
					"confirm-password": {
						validators: {
							notEmpty: {
								message: "La confirmation du mot de passe est requise"
							},
							identical: {
								compare: function() {
									return e.querySelector('[name="password"]').value
								},
								message: "Le mot de passe et sa confirmation ne sont pas les mêmes"
							}
						}
					},
					toc: {
						validators: {
							notEmpty: {
								message: "Vous devez cocher cette case."
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger({
						event: {
							password: !1
						}
					}),
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: ".fv-row",
						eleInvalidClass: "",
						eleValidClass: ""
					})
				}
			}), t.addEventListener("click", (function(s) {
				s.preventDefault(), 
				r.revalidateField("password"), r.validate().then((function(r) 
				{
					var email = getCookie("email");
					if (email === undefined) 	{
						email = e.querySelector('[name="email"]').value;
					}
					var init_password = e.querySelector('[name="password"]').value;
					console.log(email); // exemple@domaine.com
					console.log(e.querySelector('[name="password"]').value); // exemple@domaine.com


					if (email === undefined) 
					{
						
						Swal.fire({
						text: "Désolé, il semble que des erreurs aient été détectées, veuillez réessayer.",
						icon: "error",
						buttonsStyling: !1,
						confirmButtonText: "Ok, je corrige !",
						customClass: {	confirmButton: "btn btn-primary"	}})
					}


							$.ajax({
								url: 'https://extranet.martigues-tourisme.com/odyssee/authentication/sign-in/ajax_password_init.php',
								method: "POST",
								data: {
									email: email,
									password: init_password
								},
								 /* success: function (response) 
								{
									if (success) 
									{ 
										alert("Hello world!");
									}	
								}	*/
							});
						
					"Valid" == r ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, 
					setTimeout(
						(function()
						{
							
							t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
								text: "Vous avez réinitialisé votre mot de passe avec succès !",
								icon: "success",
								buttonsStyling: !1,
								confirmButtonText: "Retour",
								customClass: {
									confirmButton: "btn btn-primary"
								}
							}).then((function(t) {
								t.isConfirmed && (e.querySelector('[name="password"]').value = "", e.querySelector('[name="confirm-password"]').value = "", o.reset())
								
							}))
						}), 
					2500)
					
					) : Swal.fire({
						text: "Désolé, il semble que des erreurs aient été détectées, veuillez réessayer.",
						icon: "error",
						buttonsStyling: !1,
						confirmButtonText: "Ok, je corrige !",
						customClass: {	confirmButton: "btn btn-primary"	}
					})
				}))
			})), e.querySelector('input[name="password"]').addEventListener("input", (function() {
				this.value.length > 0 && r.updateFieldStatus("password", "NotValidated")
			}))
		}
	}
}();
KTUtil.onDOMContentLoaded((function() {
	KTPasswordResetNewPassword.init()
}));

// Fonction pour récupérer un cookie par nom
function getCookie(name) {
  let value = "; " + document.cookie;
  let parts = value.split("; " + name + "=");
  if (parts.length === 2) return parts.pop().split(";").shift();
}