const halamanDasboard = document.getElementById('tambahSiswa');

halamanDasboard.addEventListener('submit', async function (e) {

    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const kelas = document.getElementById('kelas').value;
    const jurusan = document.getElementById('jurusan').value;
    const file = document.getElementById('file').files[0]

    const formData = new FormData();

    formData.append('nama', nama);
    formData.append('kelas', kelas);
    formData.append('jurusan',jurusan);
    formData.append('file',file)




    const response = await fetch('/tambah_siswa', {
        method: 'POST',

        headers: {

            'Accept': 'application/json',

            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
        },

        body : formData
    })


    const jawaban = await response.json();

    if (jawaban.ok) {

        // hapus pesan "belum ada siswa" kalau ini siswa pertama
        const empty = document.querySelector('#tampilan_siswa .empty-state');
        if (empty) empty.remove();

        document.getElementById('tampilan_siswa').insertAdjacentHTML(
            'beforeend',

            `
               <div id="siswa-${jawaban.siswa.id}" class="siswa-card">
                   <img src="${jawaban.siswa.gambar}" width="50" height="50">
                   <p class="siswa-nama">${jawaban.siswa.nama}</p>
                   <p>Kelas: <strong>${jawaban.siswa.kelas}</strong></p>
                   <p>Jurusan: <strong>${jawaban.siswa.jurusan}</strong></p>

                   <div class="siswa-actions">
                       <form action="/editPage/${jawaban.siswa.id}">
                           <button class="btn-mini">Edit</button>
                       </form>

                       <button type="button" class="btn-mini danger hapusSiswa" data-id="${jawaban.siswa.id}">Hapus</button>
                   </div>
               </div>
            `
        );

        halamanDasboard.reset();

    }else {
        

        if (jawaban.errors?.nama) {
            
            document.getElementById('errorNama').textContent = jawaban.errors.nama

        }

        if (jawaban.errors?.kelas) {

            document.getElementById('errorKelas').textContent = jawaban.errors.kelas
        }

        if (jawaban.errors?.jurusan) {

            document.getElementById('errorJurusan').textContent = jawaban.errors.jurusan
        }

        if (jawaban.errors?.file) {

            document.getElementById('errorFile').textContent = jawaban.errors.file

        }

    }





});


const logout = document.getElementById('Keluar');


logout.addEventListener('submit', async function (e) {

    e.preventDefault();

    const response_a = await fetch('/logout', {

        method: 'POST',

        headers: {
          
            'Accept' : 'application/json',

            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },

        credentials: 'include'
    })


    const jawaban_a = await response_a.json();

    if (jawaban_a.ok) {

        window.location.href = '/';

    }else {
        console.log('hahah gak bisa');

    }

    

});