
const halaman = document.getElementById('halamanRegister');

halaman.addEventListener('submit', async function(e) {

    e.preventDefault();


    const response = await fetch('/register', {

        method : 'POST',

        headers: {
            
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',
            'X-CSRF-TOKEN' : document.querySelector(
                'meta[name="csrf-token"]'
            ).content

        },
        
        body: JSON.stringify({

            name : document.getElementById('nama').value,
            email : document.getElementById('email').value,
            password : document.getElementById('password').value
        })

    });

    const jawaban = await response.json();

    if (jawaban.ok) {
        document.getElementById('notif').textContent = jawaban.message

    }else {
        
        if (jawaban.errors?.name) {
            document.getElementById('errorName').textContent = jawaban.errors.name;
        }

        if (jawaban.errors?.email) {
            document.getElementById('errorEmail').textContent = jawaban.errors.email;
        }

        if (jawaban.errors?.password) {
            document.getElementById('errorPassword').textContent = jawaban.errors.password;
        }

    }

  


});


