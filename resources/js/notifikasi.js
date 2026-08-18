const notifikasiPage = document.getElementById('notifikasiPage');


notifikasiPage.addEventListener('submit', async function (e) {

    e.preventDefault();

    const response = await fetch('/notifikasi', {
        
        method: 'GET',

        headers: {
            
            'Accept' : 'application/json'

        },

        credentials: 'include'

    });

    const jawaban = await response.json();

    if (jawaban.ok) {
        
        const container = document.getElementById('Notifikasi');

        container.innerHTML = '';

        if (jawaban.data.length === 0) {

            container.insertAdjacentHTML(
                'beforeend',

                `<div class="empty-state">Belum ada notifikasi.</div>`
            );

            return;
        }

        jawaban.data.forEach(function (notifikasi) {

            container.insertAdjacentHTML(
                'beforeend',

                `
                <div class="notif-item">
                    <span class="notif-dot"></span>
                    <div class="notif-body">
                        <p class="notif-text">${notifikasi.pesan}</p>
                    </div>
                </div>
                `
            );
        });

    }else {

        console.log('ANj apa lagi sih');
    }


})