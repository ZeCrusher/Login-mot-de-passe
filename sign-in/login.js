if (localStorage.getItem("userToken")) {
	/* A faire pour la suite de la version Odyssée */
	// window.location.href = "index.php"; 
}

const LoginForm = (function () {
  let form, btnSubmit, isValid;
  return {
    init: function () {
      (form = document.querySelector("#login_form")),
        (btnSubmit = document.querySelector("#login_form_submit")),
        (isValid = FormValidation.formValidation(form, {
          fields: {
            'email': {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 
                                message: 'Vous devez indiquer une adresse mél valide.',
                            },
                            notEmpty: {
                                message: 'Veuillez indiquer une adresse ici.'
                            }
                        }
                    },
			'password': {
                        validators: {
                            notEmpty: {
                                message: 'Il manque le mot de passe.'
                            }
                        }
                    }
                },
          plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
              rowSelector: ".fv-row",
            }),
          },
        })),
        btnSubmit.addEventListener("click", function (n) {
          n.preventDefault(),
            isValid.validate().then(function (isValid) {
              if (isValid === "Valid") {
                btnSubmit.setAttribute("data-kt-indicator", "on"),
                  (btnSubmit.disabled = !0);
                const formData = new FormData(form);
                const credentials = Object.fromEntries(formData);

                $.ajax(
				{
				  url: "ajax-login.php", //?action=login",
                  type: "POST",
                  data: JSON.stringify(credentials),
                  contentType: "application/json; charset=utf-8",
                  success: function (response) 
				  {
                    const { success } = response;

						if (success) {
							
						  const { token, resetPassword, permissions, email } = response;

							localStorage.setItem("userToken", token);
							localStorage.setItem("resetPassword", resetPassword);
							localStorage.setItem("email", email);
							localStorage.setItem("permissions",JSON.stringify(permissions)
						  );

							if (resetPassword)	{
								document.cookie = "email="+email+"; path=/";
								window.location.href = "../sign-in/new-password.php";
							}
							else 
								window.location.href = "../../../../../../desire/index.php";
								// window.location.href = "https://www.google.fr";

							return;
						}

                    // Mauvaises informations d'identification
                    const { message } = response;
                    btnSubmit.setAttribute("data-kt-indicator", "off"),
                      (btnSubmit.disabled = !!0);
                    throwError(message);
                  },
                  error: function (_xhr, _textStatus, errorThrown) {
                    btnSubmit.setAttribute("data-kt-indicator", "off"),
                      (btnSubmit.disabled = !!0);
                    throwError(
                      "Vous ne pouvez pas vous connecter !"
                    );
                    // console.error("Error: ", errorThrown);
                  },
                });
              } else {
                throwError(
                  "Désolé, il semble que des erreurs aient été détectées, veuillez réessayer."
                );
              }
            });
        });
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  LoginForm.init();
});
function throwError(message) {
  Swal.fire({
    text: message,
    icon: "warning",
    buttonsStyling: !1,
    confirmButtonText: "Ok, j'ai compris !",
    customClass: { confirmButton: "btn btn-primary" },
  });
}
