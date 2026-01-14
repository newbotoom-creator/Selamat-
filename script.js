document.addEventListener('DOMContentLoaded', () => {
    console.log("Halaman Ulang Tahun Ayah Siap!");
    
    // Fungsi sederhana untuk membuat efek konfeti di console atau layar
    createConfetti();
});

function createConfetti() {
    for (let i = 0; i < 50; i++) {
        const confetti = document.createElement('div');
        confetti.style.position = 'fixed';
        confetti.style.width = '10px';
        confetti.style.height = '10px';
        confetti.style.backgroundColor = ['#fdbb2d', '#b21f1f', '#fff'][Math.floor(Math.random() * 3)];
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.top = '-10px';
        confetti.style.zIndex = '999';
        confetti.style.borderRadius = '50%';
        confetti.style.opacity = Math.random();
        
        document.body.appendChild(confetti);

        const fallDuration = Math.random() * 3 + 2;
        confetti.animate([
            { transform: `translateY(0) rotate(0deg)`, opacity: 1 },
            { transform: `translateY(100vh) rotate(720deg)`, opacity: 0 }
        ], {
            duration: fallDuration * 1000,
            easing: 'linear'
        });

        setTimeout(() => confetti.remove(), fallDuration * 1000);
    }
}