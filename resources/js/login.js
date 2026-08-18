const halamanLogin = document.getElementById('loginPage');


halamanLogin.addEventListener('submit', async function (e) {

    e.preventDefault();

    await fetch('/sanctum/csrf-cookie', {
        credentials: 'include'
    });

    const response = await fetch('/login', {
        method: 'POST',

        credentials: 'include',

        headers: {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',

             'X-CSRF-TOKEN' : document.querySelector(
                'meta[name="csrf-token"]'
            ).content
        },

        body: JSON.stringify({

            email: document.getElementById('email').value,
            password:  document.getElementById('password').value

        })
    });

    const jawaban = await response.json();

    if (jawaban.ok) {

        window.location.href = '/dashboard';

    }else {


        if (jawaban.errors?.email) {

            document.getElementById('errorEmail').textContent = jawaban.errors.email

        }

        if (jawaban.errors?.password) {
            
            document.getElementById('errorPassword').textContent = jawaban.errors.password

        }


        document.getElementById('notif').textContent = jawaban.message;

    }



});