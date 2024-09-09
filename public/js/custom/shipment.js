const total_berat = document.getElementById('total_berat');
const detailBarang = document.getElementById('detail_barang');
const total_exw = document.getElementById('total_exw');
const biayaLainnya = document.getElementById('biaya-lainnya');
const total_biaya_lainnya = document.getElementById('total_biaya_lainnya');
const diskon = document.getElementById('diskon');
const total_all = document.getElementById('total');
const harga_all_in = document.getElementById('harga_all_in');
const barang_all = Array.from(document.getElementById('barang').options).map(opt => {
    return {
        nama: opt.value, 
        jenis: opt.dataset.jenis,
        satuan: opt.dataset.satuan,
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Add biaya lainnya
    document.getElementById('add-biaya-lainnya').addEventListener('click', () => {
        let biaya = document.createElement('div');
        biaya.setAttribute('class', 'row');
        biaya.innerHTML = `
            <div class="col-sm-6">
                <div class="input-group">
                    <button class="btn btn-icon btn-danger m-0 px-3 remove-biaya-lainnya" type="button">
                        <i class="fa fa-xmark"></i>
                    </button>
                    <input type="text" class="form-control form-control-solid ps-2" name="nama_biaya_lainnya[]" placeholder="Nama biaya">
                </div>
            </div>
            <div class="col-sm-6 ps-0">
                <div class="input-group">
                    <span class="input-group-text border-0">Rp</span>
                    <input type="number" class="form-control form-control-solid ps-2 biaya-lainnya" name="biaya_lainnya[]" placeholder="0" min="0">
                </div>
            </div>
        `;
        biayaLainnya.appendChild(biaya);
        refreshEvent();
    });

    // Add detail barang
    document.getElementById('add-detail-barang').addEventListener('click', () => {
        let barang = document.createElement('tr');
        barang.innerHTML = `
            <td class="text-center align-middle">1</td>
            <td class="px-1">
                <input type="text" class="form-control form-control-solid nama" name="nama[]" list="barang" autocomplete="off" placeholder="Nama Barang" required>
            </td>
            <td class="px-1">
                <select class="form-select form-select-solid jenis" name="jenis[]" required disabled>
                    <option value="bahan">Bahan</option>
                    <option value="kemasan">Kemasan</option>
                </select>
            </td>
            <td class="px-1">
                <input type="number" class="form-control form-control-solid count-sub" name="jumlah[]" placeholder="0" min="0" required>
            </td>
            <td class="px-1">
                <select class="form-select form-select-solid satuan" name="satuan[]" required disabled>
                    <option value="Kg" selected>Kg</option>
                    <option value="gram">gram</option>
                    <option value="Ons">Ons</option>
                    <option value="Box">Box</option>
                    <option value="Pack">Pack</option>
                    <option value="Liter">Liter</option>
                    <option value="Lusin">Lusin</option>
                    <option value="Gros">Gros</option>
                    <option value="Rim">Rim</option>
                    <option value="Kodi">Kodi</option>
                    <option value="pcs">pcs</option>
                    <option value="meter">meter</option>
                </select>
            </td>
            <td class="px-1">
                <div class="input-group">
                    <span class="input-group-text border-0">Rp</span>
                    <input type="number" class="form-control form-control-solid count-sub" name="harga_satuan[]" placeholder="0" min="0" required>
                </div>
            </td>
            <td class="px-1">
                <div class="input-group bg-light">
                    <span class="input-group-text border-0">Rp</span>
                    <input type="number" class="form-control form-control-solid" name="subtotal[]" value="0" readonly required>
                </div>
            </td>
            <td class="px-1 align-middle text-center">
                <button class="btn btn-icon btn-danger m-0 px-3 remove-detail-barang" type="button">
                    <i class="fa fa-xmark text-sm"></i>
                </button>
            </td>
        `;
        detailBarang.prepend(barang);
        refreshEvent();
    });

    // Sanitasi diskon dan total_berat serta auto calculate_rest() oninput
    [diskon, total_berat].forEach(inp => {
        inp.addEventListener('input', () => {
            if (inp.value < 0) inp.value = 0;
            calculate_rest();
        });
    });
});

// Total semua kolom
function calculate_rest() {
    let total_berat_val = parseInt(total_berat.value) || 0;
    let diskon_val = parseInt(diskon.value) || 0;

    // Hitung total
    total_all.value = parseInt(total_exw.value) + parseInt(total_biaya_lainnya.value) - diskon_val;

    // Hitung harga all in / kg
    harga_all_in.value = (total_berat_val >= 1000) ? (parseInt(total_all.value) / (total_berat_val / 1000)).toFixed() : 0;
}

// Refresh event
function refreshEvent() {
    // Sanitasi input nama barang
    document.querySelectorAll('input.nama').forEach(nama => {
        let parent = nama.closest('tr');
        let jenis = parent.querySelector('select.jenis');
        let satuan = parent.querySelector('select.satuan');

        nama.onchange = () => {
            // Find satuan barang
            let value = nama.value;
            let find = barang_all.find(item => item.nama === value);
            
            // Reset disabled input dan background-color <tr>
            jenis.disabled = true;
            satuan.disabled = true;
            parent.classList.remove('bg-warning-subtle');
    
            // Cek apakah barang sudah ada di dalam stok atau belum
            if (value) {
                if (find) {
                    jenis.value = find.jenis;
                    satuan.value = find.satuan;
                } else {
                    if (confirm(`"${value}" tidak ada di dalam daftar barang. Apakah Anda ingin menambah barang ini ke dalam daftar stok Anda?`)) {
                        jenis.disabled = false;
                        satuan.disabled = false;
                        parent.classList.add('bg-warning-subtle');
                    } else {
                        nama.value = '';
                    }
                }
            }
        }
    });

    // Remove biaya lainnya
    document.querySelectorAll('button.remove-biaya-lainnya').forEach(btn => {
        btn.onclick = () => {
            if (biayaLainnya.childElementCount > 1) {
                btn.closest('div.row').remove();
                refreshEvent();
            }
        };
    });

    // Remove detail barang
    document.querySelectorAll('button.remove-detail-barang').forEach(btn => {
        btn.onclick = () => {
            if (detailBarang.childElementCount > 1) {
                btn.closest('tr').remove();
                refreshEvent();
            }
        };
    });

    // Counter detail barang
    detailBarang.querySelectorAll('tr').forEach((tr, i) => {
       tr.querySelector('td').innerText = i+1;
    });

    // Hitung subtotal dan total barang
    document.querySelectorAll('#detail_barang input.count-sub').forEach(inp => {
        let parent = inp.closest('tr');
        let jumlah = parent.querySelector('input[name="jumlah[]"]');
        let harga_satuan = parent.querySelector('input[name="harga_satuan[]"]');
        let subtotal = parent.querySelector('input[name="subtotal[]"]');

        inp.oninput = () => {
            // Sanitasi input jumlah dan harga satuan
            if (inp.value < 0) inp.value = 0;

            harga_satuan_val = parseInt(harga_satuan.value) || 0;
            jumlah_val = parseInt(jumlah.value) || 0;
            
            // Hitung subtotal barang
            subtotal.value = harga_satuan_val * jumlah_val;

            // Hitung total EXW
            let acc = 0;
            document.querySelectorAll('#detail_barang input[name="subtotal[]"]').forEach(sub => {
                acc += parseInt(sub.value);
            });
            total_exw.value = acc;

            // Hitung sisa
            calculate_rest();
        };
    });

    // Hitung total biaya lainnya
    document.querySelectorAll('#biaya-lainnya input.biaya-lainnya').forEach(inp => {
        inp.oninput = () => {
            let acc = 0;
            document.querySelectorAll('#biaya-lainnya input.biaya-lainnya').forEach(sub => {
                acc += parseInt(sub.value) || 0;
            });
            total_biaya_lainnya.value = acc;

             // Hitung sisa
             calculate_rest();
        };
    });
}