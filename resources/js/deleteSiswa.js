
const tombolHapus = document.getElementById('tampilan_siswa');


tombolHapus.addEventListener('click', async function (e) {

    if (!e.target.classList.contains('hapusSiswa')) {
        return;
    }


    const button = e.target;
    const id = button.dataset.id;

    const response = await fetch(`/hapus_siswa/${id}`, {

        method: 'DELETE',

        headers : {

            'Accept' : 'application/json',

            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
        },

        credentials : 'include'
    });

    const jawaban = await response.json();

    if (jawaban.ok) {

        document.getElementById(`siswa-${id}`).remove();
    }else {

        console.log('awkwkwkw gak bisa ueee');
    }


})