const searchSiswa = document.getElementById('searchSiswa');


searchSiswa.addEventListener('input', async function () {

    const keyword = this.value;
    const response = await fetch(`/search_siswa?search=${encodeURIComponent(keyword)}`, {

        method: 'GET',

        headers : {

            'Accept' : 'application/json',

        },

        credentials: 'include'

    });


    const jawaban = await response.json();

    const container = document.getElementById('tampilan_siswa');

    container.innerHTML = '';

    if (jawaban.data.length === 0) {

        container.insertAdjacentHTML(
            'beforeend',

            `<div class="empty-state">Belum ada siswa yang terdaftar.</div>`
        );

        return;
    }

    jawaban.data.forEach(function (siswa) {

        container.insertAdjacentHTML(
            'beforeend',

            `
            <div id="siswa-${siswa.id}" class="siswa-card">

                <img src="${siswa.gambar}" width="100" height="100">
                <p class="siswa-nama">${siswa.nama}</p>
                <p>Kelas: ${siswa.kelas}</p>
                <p>Jurusan: ${siswa.jurusan}</p>

            </div>
            `
        )
    })

   

  


})