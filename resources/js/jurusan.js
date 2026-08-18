const jurusanPage = document.getElementById('tambahJurusan');

jurusanPage.addEventListener('submit', async function (e) {

    e.preventDefault();


    const jurusan = document.getElementById('jurusan').value;

    const response = await fetch('/tambah_jurusan', {

        method: 'POST',

        headers: {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',

            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
        },

        body : JSON.stringify({

              jurusan : jurusan


        })

    })

    const jawaban = await response.json();

    if (jawaban.ok) {

        document.getElementById('notif').textContent = jawaban.pesan

    }else {

        document.getElementById('notif').textContent = "holy shittt"
    }

})