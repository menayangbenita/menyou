document.addEventListener('DOMContentLoaded', () => {
    // Filter angka
    let num = '1234567890.'.split('');
    document.querySelectorAll('input').forEach(inp => {
        inp.addEventListener('input', () => {
            let inputChar = inp.value.split('');
            inputChar = inputChar.filter(char => num.includes(char));
            inp.value = inputChar.join('');
        });
    });

    // Prevent empty value
    document.querySelectorAll('input').forEach(inp => {
        inp.addEventListener('change', () => {
            if (!inp.value) inp.value = 0;
        });
    });

    // Hitung sisa dari pengeluaran
     document.querySelectorAll('input.pengeluaran').forEach(inp => {
        inp.addEventListener('input', () => {
            input = parseFloat(inp.value) || 0;
            let sisa = inp.parentElement.parentElement.querySelector('input.sisa');
            let stok = inp.parentElement.parentElement.querySelector('input.stok');

            if (input > parseFloat(stok.value)) {
                inp.value = parseFloat(stok.value);
                input = parseFloat(stok.value);
            }

            sisa.value = parseFloat(stok.value) - input;
        })
     });

    // Hitung pengeluaran dari sisa
    document.querySelectorAll('input.sisa').forEach(inp => {
        inp.addEventListener('input', () => {
            input = parseFloat(inp.value) || 0;
            let pengeluaran = inp.parentElement.parentElement.querySelector('input.pengeluaran');
            let stok = inp.parentElement.parentElement.querySelector('input.stok');

            if (input > parseFloat(stok.value)) {
                inp.value = parseFloat(stok.value);
                input = parseFloat(stok.value);
            }

            pengeluaran.value = parseFloat(stok.value) - input;
        })
    });
});