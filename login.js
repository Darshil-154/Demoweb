
     // Example starter JavaScript for disabling form submissions if there are invalid fields
     (() => {
        'use strict'
      
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
      
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
      
            form.classList.add('was-validated')
          }, false)
        })
      })()
    //   const email = document.querySelector('#email');
    //  const pass = document.querySelector('#pass');
    //  var x = document.forms["form"]["email"].value;
    //  var y = document.forms["form"]["pass"].value;
     
    //    if ( x == "") {
    //     email.className = 'invalid-feedback';
    //    }                                               
    //    if ( x == "") {
    //     pass.className = 'invalid-feedback';
    //    } 
                                                      
 
                                                      
                                                      
