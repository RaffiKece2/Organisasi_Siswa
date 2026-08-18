const popupProfile = document.getElementById('editProfile');

popupProfile.addEventListener('submit', async function (e) {

    e.preventDefault();

    const nama = document.getElementById('nama').value

    const response = await fetch('/edit', {

        method: 'PATCH',

        headers : {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',

            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
        },

        credentials: 'include',


        body: JSON.stringify({
            
            name : nama

        })

    });


    const jawaban = await response.json();

    document.getElementById('notif').textContent = jawaban.message


});



