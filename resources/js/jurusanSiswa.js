const siswaPage = document.querySelectorAll('.tombolJurusan');
const daftarSiswa = document.getElementById('isiSiswa');


siswaPage.forEach(button => {

    button.addEventListener('click', async () => {

        const jurusanId = button.dataset.id;

        // tandai tombol yang sedang dipilih
        siswaPage.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const response = await fetch(`/jurusan_siswa/${jurusanId}`, {

            method: 'GET',
            headers: {
            
                'Accept' : 'application/json',    
            }

        })
        
        const jawaban = await response.json();

        if (jawaban.ok) {
            daftarSiswa.innerHTML = '';

            if (jawaban.data.length === 0) {

                daftarSiswa.innerHTML = '<div class="empty-state">Belum ada siswa di jurusan ini.</div>';
                return;
            }

            jawaban.data.forEach(siswa => {
                
                const div = document.createElement('div');
                div.className = 'siswa-card';

                div.innerHTML = `

                <img src="${siswa.gambar}" width="100" height="100">
                <p class="siswa-nama">${siswa.nama}</p>
                <p>Kelas: ${siswa.kelas}</p>
                <p>Jurusan: ${siswa.jurusan}</p>

                `;

                daftarSiswa.appendChild(div);
            })
        }else {

            const notif = document.getElementById('notif');
            notif.textContent = "awkwkwkwkw gak bisa yakkk!";
            notif.classList.add('show', 'err');


        }

    })

})