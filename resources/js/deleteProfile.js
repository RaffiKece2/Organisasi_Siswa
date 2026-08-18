const hapusProfile = document.getElementById('hapusProfile');

hapusProfile.addEventListener('submit', async function (e) {

    e.preventDefault();


    const response_a = await fetch('/hapus_profile', {

        method : 'DELETE',

        headers : {


            'Content-Type' : 'application/json',
            'Accept' : 'application/json',

            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content

        },

        credentials : 'include'

        

    });



    const jawaban = await response_a.json();

    if (jawaban.ok) {
        
        window.location.href = '/';

    }else {

        console.log('AWKWKWKWK');
    }



});